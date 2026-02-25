<?php

namespace App\Livewire\Application;

use Illuminate\Support\Str;
use Livewire\Component;
use Modules\CourseAdministration\Http\Requests\CreateLearnerTrainingApplicationRequest;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

class CreateTrainingApplicationLivewire extends Component
{
    // Form fields
    public $center_id = null;
    public $training_course_id = null;
    public $courses = [];
    public $centers = [];


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
    public $availableCourses = [];
    public $selectedCenter = null;
    public $selectedCourse = null;
    public $registration_type = 'online';

    public $search = '';
    public $pageCount = 10;

    public function mount()
    {
        // Check if the learner already has an approved application
        // $this->checkLearnerCurrentApplicationStatus();
    }

    private function checkLearnerCurrentApplicationStatus()
    {
        $existingApplication = LearnerTrainingApplication::where('user_id', auth()->user()->id)
            ->whereIn('status', ['approved'])
            ->orderBy('application_date', 'desc')
            ->first();

        // Set batchId if there's an existing approved application to prevent batch assignment in the form
        $trainingBatchId = $existingApplication ? $existingApplication->training_batch_id : null;
        $trainingCenterId = $existingApplication ? $existingApplication->center_id : null;

        $trainingBatch = TrainingBatch::where(['id' => $trainingBatchId, 'center_id' => $trainingCenterId])->first();
        if ($trainingBatch) {
            if (in_array($trainingBatch->status, ['full', 'open', 'ongoing'])) {
                session()->flash('error', 'This learner already has an active training batch. Please check the learner\'s current application status.');
                return redirect()->route('learner-training-applications.index');
            }
        }
    }

    public function save()
    {
        // Check if user already has a pending application
        $pendingApplication = LearnerTrainingApplication::where('user_id', auth()->user()->id)
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

        $validated['user_id'] = auth()->user()->id;
        $validated['application_date'] = now();
        $validated['application_number'] = 'APP-' . date('Y') . '-' . Str::random(16);
        $validated['status'] = 'pending';
        $validated['registration_type'] = 'online';

        $application = LearnerTrainingApplication::create($validated);

        // Redirect to the application detail or list page
        return redirect()->route('learner-training-applications.index')->with('success', 'Training application submitted successfully! Application Number: ' . $application->application_number);
    }

    public function render()
    {
        $this->courses = TrainingCourse::all();
        // Load centers that offer the selected course
        if ($this->training_course_id) {
            $this->centers = Center::query()
                ->join('training_center_courses', 'centers.id', '=', 'training_center_courses.center_id')
                ->where('training_center_courses.training_course_id', $this->training_course_id)
                ->where('training_center_courses.is_active', true)
                ->select('centers.*')
                ->get();
        }

        return view('livewire.application.create-training-application-livewire');
    }
}
