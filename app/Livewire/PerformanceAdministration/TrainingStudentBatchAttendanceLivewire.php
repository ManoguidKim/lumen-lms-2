<?php

namespace App\Livewire\PerformanceAdministration;

use Livewire\Component;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class TrainingStudentBatchAttendanceLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $studentBatchAttendances = StudentBatchAttendance::query()
            ->select(
                'student_batch_attendances.uuid',
                'student_batch_attendances.attendance_date',
                'student_batch_attendances.check_in_time',
                'student_batch_attendances.check_out_time',

                'training_batches.batch_name as batch_name',
                'training_batches.batch_code as batch_code',

                'training_courses.course_name as course_name',
                'training_courses.course_code as course_code',

                'training_batch_schedule_items.session_title as session_title',

                'training_schedule_items.name as schedule_name',
                'training_schedule_items.description as schedule_description',
                'training_schedule_items.schedule_days as schedule_days',
                'training_schedule_items.start_time as schedule_start_time',
                'training_schedule_items.end_time as schedule_end_time',
            )

            ->leftjoin('training_batch_students', 'student_batch_attendances.training_batch_student_id', '=', 'training_batch_students.id')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->join('training_batch_schedule_items', 'student_batch_attendances.training_batch_schedule_item_id', '=', 'training_batch_schedule_items.id')
            ->join('training_schedule_items', 'training_batch_schedule_items.training_schedule_item_id', '=', 'training_schedule_items.id')

            ->where(function ($query) {
                $query->where('training_batches.batch_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_schedule_items.name', 'like', '%' . $this->search . '%');
            })

            ->paginate($this->perPage);

        // dd($studentBatchAttendances);

        return view('livewire.performance-administration.training-student-batch-attendance-livewire', [
            'studentBatchAttendances' => $studentBatchAttendances,
        ]);
    }
}
