<?php

namespace App\Livewire\Application;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\CourseAdministration\Http\Requests\CreateLearnerTrainingApplicationRequest;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

class TrainingApplicationLivewire extends Component
{
    // Form fields
    public $center_id = null;
    public $training_course_id = null;
    public $application_date;
    public $preferred_start_date = null;
    public $learner_remarks = null;

    // Additional properties
    public $application_id = null;
    public $isEditMode = false;
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

    public function mount($applicationId = null)
    {
        $this->loadCenters();

        if ($applicationId) {
            $this->loadApplication($applicationId);
        } else {
            $this->application_date = now()->format('Y-m-d');
        }
    }

    private function loadCenters()
    {
        $this->centers = Center::where('status', 'active')
            ->orderBy('name')
            ->get();
    }

    private function loadApplication($applicationId)
    {
        $application = LearnerTrainingApplication::with(['center', 'trainingCourse', 'reviewer'])
            ->where('id', $applicationId)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $this->isEditMode = true;
        $this->application_id = $application->id;
        $this->center_id = $application->center_id;
        $this->training_course_id = $application->training_course_id;
        $this->application_date = $application->application_date->format('Y-m-d');
        $this->preferred_start_date = $application->preferred_start_date?->format('Y-m-d');
        $this->learner_remarks = $application->learner_remarks;
        $this->application_number = $application->application_number;
        $this->status = $application->status;
        $this->reviewed_by = $application->reviewed_by;
        $this->reviewed_at = $application->reviewed_at;
        $this->review_remarks = $application->review_remarks;

        if ($application->reviewer) {
            $this->reviewer_name = $application->reviewer->name;
        }

        // Load courses for the selected center
        $this->loadCoursesByCenter();
    }

    /**
     * Watch for center_id changes and load courses
     */
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

    /**
     * Watch for training_course_id changes
     */
    public function updatedTrainingCourseId($value)
    {
        if ($value) {
            $this->selectedCourse = TrainingCourse::find($value);
        } else {
            $this->selectedCourse = null;
        }
    }

    /**
     * Load courses by selected center
     */
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

    /**
     * Save the application
     */
    public function save()
    {
        // use custome validation request CreateLearnerTrainingApplicationRequest and messages
        $validated = $this->validate(
            (new CreateLearnerTrainingApplicationRequest())->rules(),
            (new CreateLearnerTrainingApplicationRequest())->messages()
        );

        $validated['user_id'] = auth()->user()->id;
        $validated['application_date'] = now();
        $validated['application_number'] = 'APP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
        $validated['status'] = 'pending';

        $application = LearnerTrainingApplication::create($validated);

        session()->flash('success', 'Training application submitted successfully! Application Number: ' . $application->application_number);

        // Redirect to the application detail or list page
        return redirect()->route('courseadministration.learner-training-applications.show', $application->id);
    }

    /**
     * Cancel the application
     */
    public function cancelApplication()
    {
        if (!$this->isEditMode || $this->status !== 'pending') {
            session()->flash('error', 'Only pending applications can be cancelled.');
            return;
        }

        try {
            $application = LearnerTrainingApplication::where('id', $this->application_id)
                ->where('user_id', auth()->user()->id)
                ->where('status', 'pending')
                ->firstOrFail();

            $application->cancel();

            session()->flash('success', 'Application cancelled successfully.');

            return redirect()->route('courseadministration.learner-training-applications.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to cancel application. Please try again.');
            Log::error('Cancel Application Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $applications = LearnerTrainingApplication::query()
            ->select('centers.name', 'training_courses.course_name', 'training_courses.course_code', 'learner_training_applications.*')
            // Joins
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            // Filter by learner
            ->where('learner_training_applications.user_id', auth()->user()->id)
            // Search filter
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('learner_training_applications.application_number', 'like', '%' . $this->search . '%')
                        ->orWhere('centers.name', 'like', '%' . $this->search . '%')
                        ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                        ->orWhere('learner_training_applications.status', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->pageCount);

        return view('livewire.application.training-application-livewire', compact('applications'));
    }
}
