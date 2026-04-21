<?php

namespace App\Livewire\PerformanceAdministration\Report;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class StudentAttendanceReport extends Component
{
    public $trainingBatch        = null;
    public $trainingBatchUuid    = null;
    public $trainingScheduleItem = null;

    public array $students      = [];
    public array $dateRange     = [];
    public array $attendanceMap = [];

    public function mount(string $trainingBatchUuid): void
    {
        $this->trainingBatchUuid    = $trainingBatchUuid;
        $this->trainingBatch        = TrainingBatch::where('uuid', $trainingBatchUuid)->firstOrFail();
        $this->trainingScheduleItem = TrainingScheduleItem::find($this->trainingBatch->training_schedule_item_id);

        $this->loadReport();
    }

    private function getScheduledDayNames(): array
    {
        if (! $this->trainingScheduleItem) {
            return [];
        }

        $days = $this->trainingScheduleItem->schedule_days;

        if (is_string($days)) {
            $days = json_decode($days, true);
        }

        return array_map('strtolower', $days ?? []);
    }

    private function getExpectedCheckIn(): ?Carbon
    {
        if (! $this->trainingScheduleItem?->start_time) {
            return null;
        }

        return Carbon::parse($this->trainingScheduleItem->start_time);
    }

    private function buildDateRange(array $scheduledDays): array
    {
        $period = CarbonPeriod::create(
            Carbon::parse($this->trainingBatch->start_date),
            Carbon::parse($this->trainingBatch->end_date)
        );

        return collect($period)
            ->filter(function (Carbon $date) use ($scheduledDays) {
                // If no schedule days defined, include every date
                if (empty($scheduledDays)) {
                    return true;
                }

                // Only include dates whose day name matches schedule_days
                // e.g. Carbon->format('l') returns "Monday", "Tuesday", etc.
                return in_array(strtolower($date->format('l')), $scheduledDays);
            })
            ->map(fn(Carbon $date) => $date->toDateString())
            ->values()
            ->toArray();
    }

    private function loadStudents(): array
    {
        return TrainingBatchStudent::query()
            ->join('users', 'training_batch_students.user_id', '=', 'users.id')
            ->where('training_batch_students.training_batch_id', $this->trainingBatch->id)
            ->select(
                'training_batch_students.id   as batch_student_id',
                'training_batch_students.user_id',
                'users.full_name_searchable    as student_name',
            )
            ->get()
            ->toArray();
    }

    private function loadAttendances(array $batchStudentIds): Collection
    {
        return StudentBatchAttendance::whereIn('training_batch_student_id', $batchStudentIds)
            ->get()
            ->groupBy(function (StudentBatchAttendance $att) {
                $date = Carbon::parse($att->attendance_date)->toDateString();
                return "{$att->training_batch_student_id}_{$date}";
            });
    }

    private function resolveTardiness(?Carbon $actualCheckIn, ?Carbon $expectedCheckIn, string $date): array
    {
        if (! $actualCheckIn || ! $expectedCheckIn) {
            return ['is_late' => false, 'minutes_late' => 0, 'severity' => null];
        }

        $expectedOnDate = Carbon::parse($date)->setTimeFrom($expectedCheckIn);

        if (! $actualCheckIn->gt($expectedOnDate)) {
            return ['is_late' => false, 'minutes_late' => 0, 'severity' => null];
        }

        $minutesLate = (int) $actualCheckIn->diffInMinutes($expectedOnDate);

        $severity = match (true) {
            $minutesLate >= 31 => 'severe',    // 31+ minutes
            $minutesLate >= 11 => 'moderate',  // 11–30 minutes
            default            => 'minor',     // 1–10 minutes
        };

        return [
            'is_late'      => true,
            'minutes_late' => $minutesLate,
            'severity'     => $severity,
        ];
    }

    private function resolveSessionStatus(?Carbon $checkIn, ?Carbon $checkOut): string
    {
        return match (true) {
            $checkIn && $checkOut => 'present',
            $checkIn || $checkOut => 'partial',
            default               => 'absent',
        };
    }

    private function resolveOverallStatus(?Carbon $amIn, ?Carbon $amOut, ?Carbon $pmIn, ?Carbon $pmOut): string
    {
        return match (true) {
            $amIn && $pmOut                     => 'present',
            $amIn || $amOut || $pmIn || $pmOut  => 'partial',
            default                             => 'absent',
        };
    }

    private function buildAbsentEntry(string $expectedInFormatted): array
    {
        return [
            'status'       => 'absent',
            'is_late'      => false,
            'minutes_late' => 0,
            'severity'     => null,
            'expected_in'  => $expectedInFormatted,
            'am'           => ['status' => 'absent', 'check_in' => null, 'check_out' => null],
            'pm'           => ['status' => 'absent', 'check_in' => null, 'check_out' => null],
        ];
    }

    private function buildAttendanceEntry(
        StudentBatchAttendance $att,
        string $date,
        ?Carbon $expectedCheckIn,
        string $expectedInFormatted
    ): array {
        $amIn  = $att->first_check_in_time   ? Carbon::parse($att->first_check_in_time)  : null;
        $amOut = $att->first_check_out_time  ? Carbon::parse($att->first_check_out_time) : null;
        $pmIn  = $att->second_check_in_time  ? Carbon::parse($att->second_check_in_time) : null;
        $pmOut = $att->second_check_out_time ? Carbon::parse($att->second_check_out_time) : null;

        $tardiness     = $this->resolveTardiness($amIn, $expectedCheckIn, $date);
        $amStatus      = $this->resolveSessionStatus($amIn, $amOut);
        $pmStatus      = $this->resolveSessionStatus($pmIn, $pmOut);
        $overallStatus = $this->resolveOverallStatus($amIn, $amOut, $pmIn, $pmOut);

        return [
            'status'       => $overallStatus,
            'is_late'      => $tardiness['is_late'],
            'minutes_late' => $tardiness['minutes_late'],
            'severity'     => $tardiness['severity'],
            'expected_in'  => $expectedInFormatted,
            'am'           => [
                'status'    => $amStatus,
                'check_in'  => $amIn?->format('g:i A'),
                'check_out' => $amOut?->format('g:i A'),
            ],
            'pm'           => [
                'status'    => $pmStatus,
                'check_in'  => $pmIn?->format('g:i A'),
                'check_out' => $pmOut?->format('g:i A'),
            ],
        ];
    }

    private function loadReport(): void
    {
        $scheduledDays       = $this->getScheduledDayNames();
        $expectedCheckIn     = $this->getExpectedCheckIn();
        $expectedInFormatted = $expectedCheckIn?->format('g:i A') ?? '';

        // Step 1 — Build date range (only scheduled days within batch period)
        $this->dateRange = $this->buildDateRange($scheduledDays);

        // Step 2 — Load students enrolled in this batch
        $this->students = $this->loadStudents();

        // Step 3 — Fetch and group all attendance records
        $batchStudentIds = collect($this->students)->pluck('batch_student_id')->toArray();
        $attendances     = $this->loadAttendances($batchStudentIds);

        // Step 4 — Build attendance map: student × scheduled date
        $this->attendanceMap = [];
        $today               = Carbon::today()->toDateString();

        foreach ($this->students as $student) {
            foreach ($this->dateRange as $date) {

                // Skip future dates — attendance not expected yet
                if ($date > $today) {
                    continue;
                }

                $lookupKey = "{$student['batch_student_id']}_{$date}";
                $att       = $attendances->get($lookupKey)?->first();

                $this->attendanceMap[$student['batch_student_id']][$date] = $att
                    ? $this->buildAttendanceEntry($att, $date, $expectedCheckIn, $expectedInFormatted)
                    : $this->buildAbsentEntry($expectedInFormatted);
            }
        }
    }

    public function render()
    {
        return view('livewire.performance-administration.report.student-attendance-report');
    }
}
