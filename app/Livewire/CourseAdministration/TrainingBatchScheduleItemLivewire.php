<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;

class TrainingBatchScheduleItemLivewire extends Component
{
    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $trainingBatchScheduleItems = TrainingBatchScheduleItem::query()
            ->select(
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_schedule_items.name as training_schedule_item_name',
                'training_schedule_items.description as training_schedule_item_description',
                'training_schedule_items.start_time as training_schedule_item_start_time',
                'training_schedule_items.end_time as training_schedule_item_end_time',
                'training_batch_schedule_items.session_title',
                'training_batch_schedule_items.description',
                'training_batch_schedule_items.session_type',
                'training_batch_schedule_items.uuid',
                'training_batch_schedule_items.notes',
            )
            // Joins
            ->join('training_batches', 'training_batch_schedule_items.training_batch_id', '=', 'training_batches.id')
            ->join('training_schedule_items', 'training_batch_schedule_items.training_schedule_item_id', '=', 'training_schedule_items.id')
            // Search Filter
            ->where('training_batch_schedule_items.session_title', 'like', '%' . $this->search . '%')
            ->orWhere('training_batch_schedule_items.description', 'like', '%' . $this->search . '%')

            ->paginate($this->perPage);

        return view('livewire.course-administration.training-batch-schedule-item-livewire', [
            'trainingBatchScheduleItems' => $trainingBatchScheduleItems,
        ]);
    }
}
