<?php

namespace App\Livewire\PerformanceAdministration\Evaluation;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;

class EvaluationIndex extends Component
{
    public $trainingBatchId;
    public $trainingBatch;
    public $trainingStudents = [];
    public $search = '';

    public function mount($uuid)
    {
        $this->trainingBatch = TrainingBatch::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $this->trainingBatchId = $this->trainingBatch->id;
        $this->trainingStudents = $this->loadStudents();
    }

    public function updatedSearch()
    {
        $this->trainingStudents = $this->loadStudents();
    }

    public function render()
    {
        return view('livewire.performance-administration.evaluation.evaluation-index');
    }

    private function loadStudents(): array
    {
        return TrainingBatchStudent::query()
            ->join('users', 'training_batch_students.user_id', '=', 'users.id')
            ->where('training_batch_students.training_batch_id', $this->trainingBatchId)
            ->when($this->search, function ($query) {
                $query->where('users.full_name_searchable', 'like', '%' . strtolower(trim($this->search)) . '%');
            })
            ->select(
                'training_batch_students.id as batch_student_id',
                'training_batch_students.user_id',
                'users.full_name_searchable as student_name',
            )
            ->orderBy('users.full_name_searchable')
            ->get()
            ->toArray();
    }
}
