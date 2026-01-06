<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingCourse;

class TrainingCourseLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $courses = TrainingCourse::paginate($this->perPage);
        return view('livewire.course-administration.training-course-livewire', [
            'courses' => $courses,
        ]);
    }
}
