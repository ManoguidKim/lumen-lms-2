<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatchStudent;

class TrainingBatchStudentLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        // Fetch training batch students for display
        $trainingBatchStudents = TrainingBatchStudent::query()
            ->select(
                'training_batches.batch_name',
                'training_batches.batch_code',
                'users.name as first_name',
                'users.middle_name',
                'users.last_name',
                'training_batch_students.enrollment_status',
                'training_batch_students.enrollment_date',
                'training_batch_students.final_grade',
                'training_batch_students.final_score',
                'training_batch_students.certificate_issued',
                'training_batch_students.certificate_date',
                'training_batch_students.remarks'
            )
            // Join tables
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->join('users', 'training_batch_students.learner_id', '=', 'users.id')
            // Apply search filter
            ->where(function ($query) {
                $query->where('training_batches.batch_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_batches.batch_code', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.middle_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('training_batch_students.created_at', 'desc')
            ->paginate($this->perPage);

        // Return the view with the data
        return view('livewire.course-administration.training-batch-student-livewire', compact('trainingBatchStudents'));
    }
}
