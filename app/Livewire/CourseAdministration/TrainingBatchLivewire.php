<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;

class TrainingBatchLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $trainingBatches = TrainingBatch::query()
            ->select(
                'training_batches.uuid',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_batches.max_participants'
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->where(function ($query) {
                $query->where('training_batches.batch_code', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_code', 'like', '%' . $this->search . '%');
            })
            ->orderBy('training_batches.created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.course-administration.training-batch-livewire', compact('trainingBatches'));
    }
}
