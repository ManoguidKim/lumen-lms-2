<?php

namespace App\Livewire\PerformanceAdministration\Evaluation;

use App\Models\User;
use Livewire\Component;
use Modules\CourseAdministration\Models\StudentTrainingEvaluation;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingRequirement;

class StudentEvaluationForm extends Component
{
    public int $batchStudentId;

    public array $ratings = [];
    public string $remarks = '';

    // Loaded models
    public $studentBatch;
    public $trainingBatch;
    public $student;
    public $trainingCourse;
    public $trainingRequirements;

    public function mount(int $batchStudentId): void
    {
        $this->batchStudentId = $batchStudentId;

        $this->studentBatch = TrainingBatchStudent::query()
            ->where('id', $batchStudentId)
            ->firstOrFail();

        $this->trainingBatch = TrainingBatch::query()
            ->where('id', $this->studentBatch->training_batch_id)
            ->firstOrFail();

        $this->student = User::query()
            ->where('id', $this->studentBatch->user_id)
            ->firstOrFail();

        $this->trainingCourse = TrainingCourse::query()
            ->where('id', $this->trainingBatch->training_course_id)
            ->firstOrFail();

        $this->trainingRequirements = TrainingRequirement::query()
            ->where('training_course_id', $this->trainingBatch->training_course_id)
            ->get();

        // Pre-fill existing ratings
        $this->ratings = StudentTrainingEvaluation::query()
            ->where('training_batch_id', $this->trainingBatch->id)
            ->where('user_id', $this->student->id)
            ->pluck('rating', 'training_requirement_id')
            ->map(fn($rating) => (string) $rating) // cast to string to match radio button values
            ->toArray();

        // Pre-fill existing remarks (take from first record, they're all the same)
        $this->remarks = StudentTrainingEvaluation::query()
            ->where('training_batch_id', $this->trainingBatch->id)
            ->where('user_id', $this->student->id)
            ->value('remarks') ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'ratings'   => ['required', 'array', 'min:1'],
            'ratings.*' => ['required', 'integer', 'between:1,5'],
            'remarks'   => ['nullable', 'string', 'max:2000'],
        ]);

        $evaluatedAt = now();
        $evaluatedBy = auth()->user()->id;

        foreach ($this->ratings as $requirementId => $score) {

            $checkExisting = StudentTrainingEvaluation::query()
                ->where('training_batch_id', $this->trainingBatch->id)
                ->where('training_requirement_id', $requirementId)
                ->where('user_id', $this->student->id)
                ->first();

            if ($checkExisting) {
                $checkExisting->update([
                    'rating' => $score,
                    'remarks' => $this->remarks,
                    'evaluated_by' => $evaluatedBy,
                    'evaluated_at' => $evaluatedAt,
                ]);
            } else {
                StudentTrainingEvaluation::create(
                    [
                        'training_batch_id'        => $this->trainingBatch->id,
                        'training_requirement_id'  => $requirementId,
                        'user_id'                  => $this->student->id,
                        'rating'        => $score,
                        'remarks'       => $this->remarks,
                        'evaluated_by'  => $evaluatedBy,
                        'evaluated_at'  => $evaluatedAt,
                    ]
                );
            }
        }

        session()->flash('success', 'Evaluation saved successfully.');
        $this->redirect(route('training_evaluation.index', ['uuid' => $this->trainingBatch->uuid]));
    }

    public function render()
    {
        return view('livewire.performance-administration.evaluation.student-evaluation-form');
    }
}
