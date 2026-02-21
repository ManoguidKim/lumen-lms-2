<?php

namespace App\Livewire\PerformanceAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Modules\PerformanceAdministration\Repositories\StudentBatchAttendanceRepository;

class CreateStudentAttendance extends Component
{
    public $trainingBatch = null;
    public $trainingBatchStudent = null;
    public $attendances = [];

    public $trainingScheduleItemId = null;

    public function mount($trainingBatchUuid)
    {
        $this->trainingBatch = TrainingBatch::where('uuid', $trainingBatchUuid)->firstOrFail();
        $this->trainingScheduleItemId = $this->trainingBatch->training_schedule_item_id;

        $this->trainingBatchStudent = TrainingBatchStudent::query()
            ->select([
                "training_batch_students.id",
                "training_batch_students.uuid",
                "training_batch_students.user_id",
                "users.name",
                "users.middle_name",
                "users.last_name",
                "users.uli",
                "users.full_name_searchable",
            ])
            ->join('users', 'users.id', '=', 'training_batch_students.user_id')
            ->where('training_batch_id', $this->trainingBatch->id)
            ->get();

        // Initialize attendances with hidden values pre-filled
        foreach ($this->trainingBatchStudent as $batchStudent) {
            $this->attendances[$batchStudent->id] = [
                'training_batch_student_id' => $batchStudent->id,
                'attendance_date'           => now()->toDateString(),
                'check_in_time'             => null,
                'check_out_time'            => null,
            ];
        }

        // dd($this->trainingBatchStudent);
    }

    public function save()
    {
        $this->validate([
            'attendances.*.check_in_time'  => 'nullable|date_format:H:i',
            'attendances.*.check_out_time' => 'nullable|date_format:H:i',
        ]);

        $studentBatchAttendanceRepository = new StudentBatchAttendanceRepository();

        foreach ($this->attendances as $attendance) {
            $existing = StudentBatchAttendance::where('training_batch_student_id', $attendance['training_batch_student_id'])
                ->where('training_batch_schedule_item_id', $this->trainingScheduleItemId)
                ->where('attendance_date', $attendance['attendance_date'])
                ->first();

            if ($existing && $existing->check_in_time && $existing->check_out_time) {
                continue;
            }

            if ($existing) {
                $existing->update([
                    'check_in_time'  => $attendance['check_in_time'] ?? $existing->check_in_time,
                    'check_out_time' => $attendance['check_out_time'],
                ]);
            } else {
                $studentBatchAttendanceRepository->create([
                    'training_batch_student_id'       => $attendance['training_batch_student_id'],
                    'training_batch_schedule_item_id' => $this->trainingScheduleItemId,
                    'attendance_date'                 => $attendance['attendance_date'],
                    'check_in_time'                   => $attendance['check_in_time'],
                    'check_out_time'                  => $attendance['check_out_time'],
                ]);
            }
        }

        return redirect()->route('training_student_batch_attendances.index')->with('success', 'Attendance records saved successfully.');
    }

    public function render()
    {
        return view('livewire.performance-administration.create-student-attendance');
    }
}
