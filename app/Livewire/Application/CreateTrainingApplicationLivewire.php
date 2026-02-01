<?php

namespace App\Livewire\Application;

use Livewire\Component;
use Modules\CourseAdministration\Http\Requests\CreateLearnerTrainingApplicationRequest;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

class CreateTrainingApplicationLivewire extends Component
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
    public $reviewed_by = null;
    public $reviewed_at = null;
    public $review_remarks = null;
    public $reviewer_name = null;

    // Collections
    public $centers = [];
    public $availableCourses = [];
    public $selectedCenter = null;
    public $selectedCourse = null;

    public $search = '';
    public $pageCount = 10;

    public function mount()
    {
        $this->loadCenters();
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
        // Check if user already has a pending application
        $pendingApplication = LearnerTrainingApplication::where('learner_id', auth()->user()->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingApplication) {
            return redirect()->route('learner-training-applications.index')->with('error', 'You already have a pending application (' . $pendingApplication->application_number . '). Please wait until it is processed before submitting a new one.');
        }

        // use custome validation request CreateLearnerTrainingApplicationRequest rules and messages
        $validated = $this->validate(
            (new CreateLearnerTrainingApplicationRequest())->rules(),
            (new CreateLearnerTrainingApplicationRequest())->messages()
        );

        $validated['learner_id'] = auth()->user()->id;
        $validated['application_date'] = now();
        $validated['application_number'] = 'APP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
        $validated['status'] = 'pending';

        $application = LearnerTrainingApplication::create($validated);

        // Redirect to the application detail or list page
        return redirect()->route('learner-training-applications.index')->with('success', 'Training application submitted successfully! Application Number: ' . $application->application_number);
    }

    public function render()
    {
        return view('livewire.application.create-training-application-livewire');
    }
}
