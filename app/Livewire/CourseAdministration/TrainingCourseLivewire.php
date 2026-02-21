<?php

namespace App\Livewire\CourseAdministration;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingCourse;

class TrainingCourseLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $courses = TrainingCourse::query()
            ->join('training_center_courses', 'training_courses.id', '=', 'training_center_courses.training_course_id')
            ->join('centers', 'training_center_courses.center_id', '=', 'centers.id')
            ->select(
                'training_courses.*',
                DB::raw('GROUP_CONCAT(centers.name SEPARATOR ", ") as center_names'),
                DB::raw('GROUP_CONCAT(centers.id SEPARATOR ",") as center_ids')
            )
            ->where('training_center_courses.is_active', true)
            ->groupBy('training_courses.id')
            ->paginate($this->perPage);


        return view('livewire.course-administration.training-course-livewire', [
            'courses' => $courses,
        ]);
    }
}
