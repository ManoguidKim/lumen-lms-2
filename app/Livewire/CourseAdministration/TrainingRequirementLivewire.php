<?php

namespace App\Livewire\CourseAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingRequirement;
use Illuminate\Support\Str;
use Modules\CourseAdministration\Models\TrainingCourse;

class TrainingRequirementLivewire extends Component
{
    public $trainingCourseId;

    public $requirements = [];

    public $courseName;

    public function mount($uuid)
    {
        $trainingCourse = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        $this->trainingCourseId = $trainingCourse->id;
        $this->courseName = $trainingCourse->course_name;

        $this->loadRequirements();
    }

    public function loadRequirements()
    {
        $this->requirements = TrainingRequirement::where('training_course_id', $this->trainingCourseId)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'requirement_name' => $item->requirement_name,
                    'requirement_description' => $item->requirement_description,
                ];
            })->toArray();

        if (empty($this->requirements)) {
            $this->addRequirement();
        }
    }

    public function addRequirement()
    {
        $this->requirements[] = [
            'id' => null,
            'requirement_name' => '',
            'requirement_description' => '',
        ];
    }

    public function removeRequirement($index)
    {
        if (isset($this->requirements[$index]['id'])) {
            TrainingRequirement::find($this->requirements[$index]['id'])?->delete();
        }

        unset($this->requirements[$index]);
        $this->requirements = array_values($this->requirements);
    }

    public function save()
    {
        $this->validate([
            'requirements.*.requirement_name' => 'required|string|max:255',
            'requirements.*.requirement_description' => 'nullable|string',
        ]);

        foreach ($this->requirements as $req) {

            if (!empty($req['id'])) {
                TrainingRequirement::where('id', $req['id'])->update([
                    'requirement_name' => $req['requirement_name'],
                    'requirement_description' => $req['requirement_description'],
                ]);
            } else {
                TrainingRequirement::create([
                    'training_course_id' => $this->trainingCourseId,
                    'requirement_name' => $req['requirement_name'],
                    'requirement_description' => $req['requirement_description'],
                ]);
            }
        }

        session()->flash('success', 'Training requirements saved successfully.');

        $this->loadRequirements();
    }

    public function render()
    {
        return view('livewire.course-administration.training-requirement-livewire');
    }
}
