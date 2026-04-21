<?php

namespace App\Livewire\PerformanceAdministration;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Modules\PerformanceAdministration\Models\StudentTrainingBatchTardinessRecord;

class TrainingStudentBatchAttendanceLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        // Fetch training batches with the count of registered students, filtered by the authenticated trainer and search term
        $trainingBatches = TrainingBatch::query()
            ->select(
                'training_batches.id',
                'training_batches.uuid',
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_schedule_items.name as training_schedule_item_name',
                'training_schedule_items.start_time as training_schedule_item_start_time',
                'training_schedule_items.end_time as training_schedule_item_end_time',
                'training_batches.max_participants',
                DB::raw('COUNT(training_batch_students.id) as registered_students_count')
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->join('training_schedule_items', 'training_batches.training_schedule_item_id', '=', 'training_schedule_items.id')
            ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')

            ->where('training_batches.trainer_id', auth()->user()->id)
            ->whereIn('training_batches.status', ['open', 'ongoing'])

            ->where(function ($query) {
                $query->where('training_batches.batch_code', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_code', 'like', '%' . $this->search . '%');
            })
            ->groupBy(
                'training_batches.id',
                'training_batches.uuid',
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_batches.max_participants'
            )
            ->orderBy('training_batches.created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.performance-administration.training-student-batch-attendance-livewire', [
            'trainingBatches' => $trainingBatches,
        ]);
    }

    public function completeTrainingBatch($trainingBatchUuid)
    {
        // Update the status of the training batch to "Completed"
        $result = TrainingBatch::where('uuid', $trainingBatchUuid)->update(['status' => 'completed']);
        if ($result) {
            $this->getTrainingBatchStudentTardiness($trainingBatchUuid);
        }
    }

    // private function getTrainingBatchStudentTardiness(string $trainingBatchUuid): void
    // {
    //     $trainingBatch = TrainingBatch::where('uuid', $trainingBatchUuid)->firstOrFail();

    //     $scheduleItem  = TrainingScheduleItem::where('id', $trainingBatch->training_schedule_item_id)->first();
    //     $batchStartTime = Carbon::parse($scheduleItem->start_time);

    //     $students = DB::table('training_batch_students')
    //         ->join('users', 'training_batch_students.user_id', '=', 'users.id')
    //         ->select('users.id as user_id', 'users.full_name_searchable', 'users.email')
    //         ->where('training_batch_students.training_batch_id', $trainingBatch->id)
    //         ->get();

    //     // Pre-fetch all attendance records for the batch in one query
    //     $attendances = StudentBatchAttendance::where('training_batch_student_id', function ($query) use ($trainingBatch) {
    //         $query->select('id')
    //             ->from('training_batch_students')
    //             ->where('training_batch_id', $trainingBatch->id);
    //     })
    //         ->where('training_batch_schedule_item_id', $trainingBatch->training_schedule_item_id)
    //         ->whereNotNull('first_check_in_time')
    //         ->whereBetween('attendance_date', [$trainingBatch->start_date, $trainingBatch->end_date])
    //         ->get()
    //         ->groupBy(fn($a) => $a->training_batch_student_id . '_' . $a->attendance_date);

    //     // Pre-fetch existing tardiness records to avoid duplicate inserts
    //     $existingTardiness = StudentTrainingBatchTardinessRecord::where('training_batch_id', $trainingBatch->id)
    //         ->pluck('tardiness_date', 'student_id')
    //         ->toArray();

    //     $tardinessRecords = [];

    //     $startDate = Carbon::parse($trainingBatch->start_date);
    //     $endDate   = Carbon::parse($trainingBatch->end_date);

    //     foreach ($students as $student) {
    //         $tempDate = $startDate->clone();

    //         while ($tempDate <= $endDate) {
    //             $dateString = $tempDate->toDateString();

    //             $studentAttendance = $attendances->get($student->user_id . '_' . $dateString)?->first();

    //             if ($studentAttendance) {
    //                 $studentFirstCheckIn = Carbon::parse($studentAttendance->first_check_in_time);

    //                 if ($studentFirstCheckIn->gt($batchStartTime)) {
    //                     $minutesLate = $studentFirstCheckIn->diffInMinutes($batchStartTime);

    //                     if (!isset($existingTardiness[$student->user_id])) {
    //                         $tardinessRecords[] = [
    //                             'training_batch_id' => $trainingBatch->id,
    //                             'student_id' => $student->user_id,
    //                             'tardiness_date' => $dateString,
    //                             'expected_check_in_time' => $batchStartTime->format('H:i:s'),
    //                             'actual_check_in_time' => $studentFirstCheckIn->format('H:i:s'),
    //                             'minutes_late' => $minutesLate,
    //                             'severity' => $this->getSeverity($minutesLate),
    //                             'remarks' => 'Late arrival'
    //                         ];
    //                     }
    //                 }
    //             }

    //             $tempDate->addDay();
    //         }
    //     }

    //     if (!empty($tardinessRecords)) {
    //         StudentTrainingBatchTardinessRecord::insert($tardinessRecords);
    //     }

    //     session()->flash('message', 'Training batch tardiness records processed successfully.');
    // }

    // private function getSeverity(int $minutesLate): string
    // {
    //     return match (true) {
    //         $minutesLate <= 10 => 'minor',
    //         $minutesLate <= 30 => 'moderate',
    //         default            => 'severe',
    //     };
    // }

    private function getTrainingBatchStudentTardiness($trainingBatchUuid)
    {
        $trainingBatch = TrainingBatch::where('uuid', $trainingBatchUuid)->first();
        $trainingBatchScheduleItem = $trainingBatch->training_schedule_item_id;

        $students = DB::table('training_batch_students')
            ->join('users', 'training_batch_students.user_id', '=', 'users.id')
            ->select('training_batch_students.id as training_batch_student_id', 'users.id as user_id', 'users.full_name_searchable', 'users.email')
            ->where('training_batch_students.training_batch_id', $trainingBatch->id)
            ->get();

        // Get Training Schedule Item details
        $trainingBatchScheduleItemDetails = TrainingScheduleItem::where('id', $trainingBatchScheduleItem)->first();
        // Get the start time of the schedule item
        $batchStartTime = Carbon::parse($trainingBatchScheduleItemDetails->start_time);

        // Iterate through each student and create attendance records
        foreach ($students as $student) {

            $tempStartDate = Carbon::parse($trainingBatch->start_date);
            $tempEndDate = Carbon::parse($trainingBatch->end_date);
            while ($tempStartDate <= $tempEndDate) {

                $dateString = $tempStartDate->toDateString();
                // Check if an attendance record already exists for this student and schedule item
                $attendance = StudentBatchAttendance::where('training_batch_student_id', $student->training_batch_student_id)
                    ->where('training_batch_schedule_item_id', $trainingBatchScheduleItem)
                    ->whereDate('attendance_date', $dateString)
                    ->first();

                if ($attendance) {
                    // get student first time in
                    $studentFirstCheckIn = Carbon::parse($attendance->first_check_in_time);
                    if ($studentFirstCheckIn > $batchStartTime) {
                        $minutesLate = $batchStartTime->diffInMinutes($studentFirstCheckIn);
                        // dd($minutesLate);
                        (new StudentTrainingBatchTardinessRecord())->create(
                            [
                                'training_batch_id' => $trainingBatch->id,
                                'user_id' => $student->user_id,
                                'tardiness_date' => $tempStartDate,
                                'expected_check_in_time' => $batchStartTime->format('H:i:s'),
                                'actual_check_in_time' => $studentFirstCheckIn->format('H:i:s'),
                                'minutes_late' => $minutesLate,
                                'severity' => $this->getSeverity($minutesLate),
                                'remarks' => 'Late arrival'
                            ]
                        );
                    }
                }

                $tempStartDate->addDay();
            }
        }
        session()->flash('message', 'Training batch completed successfully.');
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
}
