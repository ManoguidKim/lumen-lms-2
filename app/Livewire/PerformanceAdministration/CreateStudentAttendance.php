<?php

namespace App\Livewire\PerformanceAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Modules\PerformanceAdministration\Repositories\StudentBatchAttendanceRepository;

class CreateStudentAttendance extends Component
{
    public $trainingBatch          = null;
    public $attendances            = [];
    public $trainingScheduleItemId = null;
    public $attendanceDate         = null;

    public function mount($trainingBatchUuid)
    {
        $this->trainingBatch          = TrainingBatch::where('uuid', $trainingBatchUuid)->firstOrFail();
        $this->trainingScheduleItemId = $this->trainingBatch->training_schedule_item_id;
        $this->attendanceDate         = now()->toDateString();

        $this->initializeAttendances();
    }

    // -------------------------------------------------------
    // Private Helpers
    // -------------------------------------------------------

    private function getStudents()
    {
        return TrainingBatchStudent::query()
            ->select([
                'training_batch_students.id',
                'training_batch_students.uuid',
                'training_batch_students.user_id',
                'users.name',
                'users.middle_name',
                'users.last_name',
                'users.uli',
                'users.full_name_searchable',
            ])
            ->join('users', 'users.id', '=', 'training_batch_students.user_id')
            ->where('training_batch_id', $this->trainingBatch->id)
            ->get();
    }

    private function getExistingRecord(int $studentId): ?StudentBatchAttendance
    {
        return StudentBatchAttendance::where('training_batch_student_id', $studentId)
            ->where('training_batch_schedule_item_id', $this->trainingScheduleItemId)
            ->where('attendance_date', $this->attendanceDate)
            ->first();
    }

    private function parseTime(?string $time): ?string
    {
        return $time ? \Carbon\Carbon::parse($time)->format('H:i') : null;
    }

    private function initializeAttendances(): void
    {
        $students = $this->getStudents();

        foreach ($students as $batchStudent) {
            $existing = $this->getExistingRecord($batchStudent->id);

            $this->attendances[$batchStudent->id] = [
                'training_batch_student_id' => $batchStudent->id,
                'first_check_in_time'       => $this->parseTime($existing?->first_check_in_time),
                'first_check_out_time'      => $this->parseTime($existing?->first_check_out_time),
                'second_check_in_time'      => $this->parseTime($existing?->second_check_in_time),
                'second_check_out_time'     => $this->parseTime($existing?->second_check_out_time),
            ];
        }
    }

    // -------------------------------------------------------
    // Livewire Hooks
    // -------------------------------------------------------

    public function updatedAttendanceDate(): void
    {
        $this->initializeAttendances();
    }

    // -------------------------------------------------------
    // Actions
    // -------------------------------------------------------

    public function markTime(int $studentId, string $field): void
    {
        $allowedFields = [
            'first_check_in_time',
            'first_check_out_time',
            'second_check_in_time',
            'second_check_out_time',
        ];

        if (!isset($this->attendances[$studentId]) || !in_array($field, $allowedFields)) {
            return;
        }

        $existing = $this->getExistingRecord($studentId);
        if ($existing && !empty($existing->$field)) {
            return;
        }

        $time = now()->format('H:i');
        $this->attendances[$studentId][$field] = $time;

        if ($existing) {
            $existing->update([
                $field => $time,
            ]);
        } else {
            (new StudentBatchAttendanceRepository())->create([
                'training_batch_student_id'       => $studentId,
                'training_batch_schedule_item_id' => $this->trainingScheduleItemId,
                'attendance_date'                 => $this->attendanceDate,
                'first_check_in_time'             => $field === 'first_check_in_time'  ? $time : null,
                'first_check_out_time'            => $field === 'first_check_out_time' ? $time : null,
                'second_check_in_time'            => $field === 'second_check_in_time'  ? $time : null,
                'second_check_out_time'           => $field === 'second_check_out_time' ? $time : null,
            ]);
        }
    }

    public function clearTime(int $studentId, string $field): void
    {
        $allowedFields = [
            'first_check_in_time',
            'first_check_out_time',
            'second_check_in_time',
            'second_check_out_time',
        ];

        if (!isset($this->attendances[$studentId]) || !in_array($field, $allowedFields)) {
            return;
        }

        // Update local state
        $this->attendances[$studentId][$field] = null;

        // ✅ Clear in DB immediately
        $existing = $this->getExistingRecord($studentId);
        if ($existing) {
            $existing->update([
                $field => null,
            ]);
        }
    }

    public function markAllTime(string $field): void
    {
        $allowedFields = [
            'first_check_in_time',
            'first_check_out_time',
            'second_check_in_time',
            'second_check_out_time',
        ];

        if (!in_array($field, $allowedFields)) {
            return;
        }

        $time       = now()->format('H:i');
        $repository = new StudentBatchAttendanceRepository();

        foreach ($this->attendances as $studentId => $attendance) {
            $existing = $this->getExistingRecord($studentId);

            // Skip if already saved in DB
            if ($existing && !empty($existing->$field)) {
                continue;
            }

            // Update local state
            $this->attendances[$studentId][$field] = $time;

            // ✅ Save to DB immediately
            if ($existing) {
                $existing->update([
                    $field => $time,
                ]);
            } else {
                $repository->create([
                    'training_batch_student_id'       => $studentId,
                    'training_batch_schedule_item_id' => $this->trainingScheduleItemId,
                    'attendance_date'                 => $this->attendanceDate,
                    'first_check_in_time'             => $field === 'first_check_in_time'  ? $time : null,
                    'first_check_out_time'            => $field === 'first_check_out_time' ? $time : null,
                    'second_check_in_time'            => $field === 'second_check_in_time'  ? $time : null,
                    'second_check_out_time'           => $field === 'second_check_out_time' ? $time : null,
                ]);
            }
        }
    }

    // public function save(): mixed
    // {
    //     $this->validate([
    //         'attendances.*.first_check_in_time'   => 'nullable|date_format:H:i',
    //         'attendances.*.first_check_out_time'  => 'nullable|date_format:H:i',
    //         'attendances.*.second_check_in_time'  => 'nullable|date_format:H:i',
    //         'attendances.*.second_check_out_time' => 'nullable|date_format:H:i',
    //     ]);

    //     $repository = new StudentBatchAttendanceRepository();

    //     foreach ($this->attendances as $attendance) {

    //         // Guard — skip if no times marked at all
    //         $hasAnyTime = $attendance['first_check_in_time']
    //             || $attendance['first_check_out_time']
    //             || $attendance['second_check_in_time']
    //             || $attendance['second_check_out_time'];

    //         if (!$hasAnyTime) {
    //             continue;
    //         }

    //         $existing = StudentBatchAttendance::where('training_batch_student_id', $attendance['training_batch_student_id'])
    //             ->where('attendance_date', $this->attendanceDate)
    //             ->when($this->trainingScheduleItemId, function ($q) {
    //                 $q->where('training_batch_schedule_item_id', $this->trainingScheduleItemId);
    //             })
    //             ->first();

    //         if ($existing) {
    //             $existing->update([
    //                 'first_check_in_time'   => $attendance['first_check_in_time']   ?? $existing->first_check_in_time,
    //                 'first_check_out_time'  => $attendance['first_check_out_time']  ?? $existing->first_check_out_time,
    //                 'second_check_in_time'  => $attendance['second_check_in_time']  ?? $existing->second_check_in_time,
    //                 'second_check_out_time' => $attendance['second_check_out_time'] ?? $existing->second_check_out_time,
    //             ]);
    //         } else {
    //             $repository->create([
    //                 'training_batch_student_id'       => $attendance['training_batch_student_id'],
    //                 'training_batch_schedule_item_id' => $this->trainingScheduleItemId,
    //                 'attendance_date'                 => $this->attendanceDate,
    //                 'first_check_in_time'             => $attendance['first_check_in_time'],
    //                 'first_check_out_time'            => $attendance['first_check_out_time'],
    //                 'second_check_in_time'            => $attendance['second_check_in_time'],
    //                 'second_check_out_time'           => $attendance['second_check_out_time'],
    //             ]);
    //         }
    //     }

    //     return redirect()
    //         ->route('training_student_batch_attendances.index')
    //         ->with('success', 'Attendance records saved successfully.');
    // }

    // -------------------------------------------------------
    // Render
    // -------------------------------------------------------

    public function render()
    {
        return view('livewire.performance-administration.create-student-attendance', [
            'trainingBatchStudent' => $this->getStudents(),
        ]);
    }
}
