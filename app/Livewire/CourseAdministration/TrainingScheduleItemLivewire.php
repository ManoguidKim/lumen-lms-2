<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingScheduleItem;

class TrainingScheduleItemLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $scheduleItems = TrainingScheduleItem::where('name', 'like', "%{$this->search}%")->paginate();
        return view('livewire.course-administration.training-schedule-item-livewire', compact('scheduleItems'));
    }
}
