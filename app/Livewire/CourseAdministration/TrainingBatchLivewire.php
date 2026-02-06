<?php

namespace App\Livewire\CourseAdministration;

use Illuminate\Support\Facades\DB;
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
                'training_batches.id',
                'training_batches.uuid',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_batches.max_participants',
                DB::raw('COUNT(training_batch_students.id) as registered_students_count')
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')
            ->where(function ($query) {
                $query->where('training_batches.batch_code', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_code', 'like', '%' . $this->search . '%');
            })
            ->groupBy(
                'training_batches.id',
                'training_batches.uuid',
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

        // Update batches staus if max_applicant == total applicant
        foreach ($trainingBatches as $batch) {
            if ($batch->registered_students_count >= $batch->max_participants && $batch->status !== 'full') {
                TrainingBatch::where('id', $batch->id)->update(['status' => 'full']);
            }
        }

        return view('livewire.course-administration.training-batch-livewire', compact('trainingBatches'));
    }
}
