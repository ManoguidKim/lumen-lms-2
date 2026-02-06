<?php

namespace App\Livewire\Application;

use Livewire\Component;
use Modules\CourseAdministration\Http\Requests\UpdateLearnerTrainingApplicationRequest;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

class UpdateTrainingApplicationLivewire extends Component
{
    // Form fields
    public $center_id = null;
    public $training_course_id = null;
    public $application_date;
    public $preferred_start_date = null;
    public $learner_remarks = null;

    // Additional properties
    public $application_id = null;
    public $application_number = null;
    public $status = null;

    // Collections
    public $centers = [];
    public $availableCourses = [];
    public $selectedCenter = null;
    public $selectedCourse = null;

    public function mount($uuid)
    {
        $this->loadCenters();

        $application = LearnerTrainingApplication::query()
            ->where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        // dd($application);

        $this->application_id = $application->id;
        $this->center_id = $application->center_id;
        $this->training_course_id = $application->training_course_id;
        $this->application_date = $application->application_date->format('Y-m-d');
        $this->preferred_start_date = $application->preferred_start_date?->format('Y-m-d');
        $this->learner_remarks = $application->learner_remarks;
        $this->application_number = $application->application_number;
        $this->status = $application->status;

        $this->loadCoursesByCenter();
    }

    private function loadCenters()
    {
        $this->centers = Center::where('status', 'active')
            ->orderBy('name')
            ->get();
    }

    public function updatedCenterId($value)
    {
        $this->training_course_id = null;
        $this->selectedCourse = null;

        if ($value) {
            $this->loadCoursesByCenter();
            $this->selectedCenter = Center::find($value);
        } else {
            $this->availableCourses = [];
            $this->selectedCenter = null;
        }
    }

    public function updatedTrainingCourseId($value)
    {
        if ($value) {
            $this->selectedCourse = TrainingCourse::find($value);
        } else {
            $this->selectedCourse = null;
        }
    }

    private function loadCoursesByCenter()
    {
        if ($this->center_id) {
            $this->availableCourses = TrainingCourse::where('center_id', $this->center_id)
                ->where('status', 'active')
                ->orderBy('course_name')
                ->get();
        } else {
            $this->availableCourses = [];
        }
    }

    public function save()
    {
        if ($this->status !== 'pending') {
            return redirect()->route('learner-training-applications.index')->with('success', 'Only pending applications can be updated.');
        }

        $validated = $this->validate(
            (new UpdateLearnerTrainingApplicationRequest())->rules(),
            (new UpdateLearnerTrainingApplicationRequest())->messages()
        );

        try {
            LearnerTrainingApplication::where('id', $this->application_id)
                ->update([
                    'center_id' => $validated['center_id'],
                    'training_course_id' => $validated['training_course_id'],
                    'learner_remarks' => $validated['learner_remarks'],
                ]);

            return redirect()->route('learner-training-applications.index')->with('success', 'Application updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('learner-training-applications.index')->with('error', 'Unable to update application. Please try again.');
        }
    }

    public function cancelApplication()
    {
        if ($this->status !== 'pending') {
            session()->flash('error', 'Only pending applications can be cancelled.');
            return;
        }

        try {
            LearnerTrainingApplication::where('id', $this->application_id)
                ->update([
                    'status' => 'cancelled',
                ]);

            return redirect()->route('learner-training-applications.index')->with('success', 'Application cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()->route('learner-training-applications.index')->with('error', 'Unable to cancel application. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.application.update-training-application-livewire');
    }
}
