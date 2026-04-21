<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class StatisticController extends Controller
{
    public function studentStats()
    {
        $userId = auth()->user()->id;

        // Compute tardiness stats for display only
        $tardiness = $this->computeUserTardiness($userId);
        // Computer absences for display only
        $absences = $this->computeUserAbsences($userId);

        return view('statistics.student', compact('tardiness', 'absences'));
    }

    private function computeUserTardiness($userId): array
    {
        $trainingBatches = DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $userId)
            ->select(
                'training_batches.id as training_batch_id',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.training_schedule_item_id',
                'training_batch_students.id as training_batch_student_id'
            )
            ->get();

        $totalBatches  = $trainingBatches->count();
        $totalLate     = 0;
        $minor         = 0;
        $moderate      = 0;
        $severe        = 0;
        $totalMinutes  = 0;

        foreach ($trainingBatches as $batch) {
            $scheduleItem = TrainingScheduleItem::find($batch->training_schedule_item_id);
            if (!$scheduleItem) continue;

            $batchStartTime = Carbon::parse($scheduleItem->start_time);
            $tempStartDate  = Carbon::parse($batch->start_date);
            $tempEndDate    = Carbon::parse($batch->end_date);

            while ($tempStartDate <= $tempEndDate) {
                $attendance = StudentBatchAttendance::where('training_batch_student_id', $batch->training_batch_student_id)
                    ->where('training_batch_schedule_item_id', $batch->training_schedule_item_id)
                    ->whereDate('attendance_date', $tempStartDate->toDateString())
                    ->first();

                if ($attendance && $attendance->first_check_in_time) {
                    $checkIn = Carbon::parse($attendance->first_check_in_time);
                    if ($checkIn > $batchStartTime) {
                        $minutes = $batchStartTime->diffInMinutes($checkIn);
                        $totalLate++;
                        $totalMinutes += $minutes;
                        $severity = $this->getSeverity($minutes);
                        if ($severity === 'minor')    $minor++;
                        if ($severity === 'moderate') $moderate++;
                        if ($severity === 'severe')   $severe++;
                    }
                }

                $tempStartDate->addDay();
            }
        }

        $avgMinutes = $totalLate > 0 ? round($totalMinutes / $totalLate) : 0;

        return [
            'total_batches'  => $totalBatches,
            'total_late'     => $totalLate,
            'minor'          => $minor,
            'moderate'       => $moderate,
            'severe'         => $severe,
            'avg_minutes'    => $avgMinutes,
            'minor_pct'      => $totalLate > 0 ? round(($minor / $totalLate) * 100) : 0,
            'moderate_pct'   => $totalLate > 0 ? round(($moderate / $totalLate) * 100) : 0,
            'severe_pct'     => $totalLate > 0 ? round(($severe / $totalLate) * 100) : 0,
        ];
    }

    private function getSeverity($lateMinutes)
    {
        if ($lateMinutes >= 1 && $lateMinutes <= 10) {
            return 'minor';
        } elseif ($lateMinutes >= 11 && $lateMinutes <= 30) {
            return 'moderate';
        } elseif ($lateMinutes > 30) {
            return 'severe';
        }
    }

    private function computeUserAbsences($userId): array
    {
        $trainingBatches = DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $userId)
            ->select(
                'training_batches.id                as training_batch_id',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.training_schedule_item_id',
                'training_batch_students.id         as training_batch_student_id'
            )
            ->get();

        $totalAbsent  = 0;
        $totalPartial = 0;
        $totalDays    = 0;
        $today        = Carbon::today()->toDateString();

        foreach ($trainingBatches as $batch) {
            $scheduleItem  = TrainingScheduleItem::find($batch->training_schedule_item_id);
            $scheduledDays = $this->resolveScheduledDays($scheduleItem);
            $dateRange     = $this->buildScheduledDateRange(
                $batch->start_date,
                $batch->end_date,
                $scheduledDays,
                $today
            );

            // Fetch all attendance records for this student+batch, keyed by date
            $attendances = StudentBatchAttendance::where('training_batch_student_id', $batch->training_batch_student_id)
                ->where('training_batch_schedule_item_id', $batch->training_schedule_item_id)
                ->get()
                ->keyBy(fn($att) => Carbon::parse($att->attendance_date)->toDateString());

            foreach ($dateRange as $date) {
                $totalDays++;
                $att = $attendances->get($date);

                if (! $att) {
                    $totalAbsent++;
                    continue;
                }

                $amIn  = $att->first_check_in_time   ? Carbon::parse($att->first_check_in_time)  : null;
                $amOut = $att->first_check_out_time   ? Carbon::parse($att->first_check_out_time) : null;
                $pmIn  = $att->second_check_in_time   ? Carbon::parse($att->second_check_in_time) : null;
                $pmOut = $att->second_check_out_time  ? Carbon::parse($att->second_check_out_time) : null;

                // Mirror StudentAttendanceReport::resolveOverallStatus()
                $status = match (true) {
                    $amIn && $pmOut                    => 'present',
                    $amIn || $amOut || $pmIn || $pmOut => 'partial',
                    default                            => 'absent',
                };

                if ($status === 'absent')  $totalAbsent++;
                if ($status === 'partial') $totalPartial++;
            }
        }

        return [
            'total_days'    => $totalDays,
            'total_absent'  => $totalAbsent,
            'total_partial' => $totalPartial,
            'absent_pct'    => $totalDays > 0 ? round(($totalAbsent  / $totalDays) * 100) : 0,
            'partial_pct'   => $totalDays > 0 ? round(($totalPartial / $totalDays) * 100) : 0,
        ];
    }

    // Used only by computeUserAbsences()
    private function resolveScheduledDays(?TrainingScheduleItem $scheduleItem): array
    {
        if (! $scheduleItem) return [];

        $days = $scheduleItem->schedule_days;
        if (is_string($days)) {
            $days = json_decode($days, true);
        }

        return array_map('strtolower', $days ?? []);
    }

    // Used only by computeUserAbsences()
    private function buildScheduledDateRange(
        string $startDate,
        string $endDate,
        array  $scheduledDays,
        string $today
    ): array {
        $period = CarbonPeriod::create(
            Carbon::parse($startDate),
            Carbon::parse($endDate)
        );

        return collect($period)
            ->filter(function (Carbon $date) use ($scheduledDays, $today) {
                if ($date->toDateString() > $today) return false;
                if (empty($scheduledDays))          return true;

                return in_array(strtolower($date->format('l')), $scheduledDays);
            })
            ->map(fn(Carbon $date) => $date->toDateString())
            ->values()
            ->toArray();
    }
}
