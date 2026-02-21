<?php

namespace App\Livewire\Application;

use App\Models\User;
use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;

class ApplicationListNoBatchLivewire extends Component
{
    public $search = '';
    public $pageCount = 10;
    public $selectedIds = [];
    public $openAssignBatchModal = false;

    public $trainingCourseId = null;
    public $trainingCenterId = null;

    public $trainingBatchId = null;

    public $trainingCourses = [];
    public $trainingCenters = [];
    public $trainingBatches = [];

    public function render()
    {
        $applicants = User::query()

            ->select('centers.name as center_name', 'training_courses.course_name', 'training_courses.course_code', 'learner_training_applications.*', 'users.name', 'users.middle_name', 'users.last_name', 'training_batches.batch_name', 'training_batches.batch_code')
            // Joins
            ->leftjoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            ->leftjoin('training_batches', 'training_batches.id', '=', 'learner_training_applications.training_batch_id')
            // Filter by learner
            ->whereIn('learner_training_applications.status', ['pending'])
            ->whereNull('learner_training_applications.training_batch_id')

            ->orderByRaw("FIELD(learner_training_applications.status, 'pending')")
            ->paginate($this->pageCount);

        // Always load all active courses
        $this->trainingCourses = TrainingCourse::get();

        // Load centers that offer the selected course via pivot
        if ($this->trainingCourseId) {
            $course = TrainingCourse::find($this->trainingCourseId);
            $this->trainingCenters = $course?->centers ?? collect();
        }

        // Load batches for selected course + center
        if ($this->trainingCourseId && $this->trainingCenterId) {
            $this->trainingBatches = TrainingBatch::query()
                ->where('training_course_id', $this->trainingCourseId)
                ->where('center_id', $this->trainingCenterId)
                ->whereIn('status', ['open', 'ongoing'])
                ->get();
        }


        return view('livewire.application.application-list-no-batch-livewire', [
            'applicants' => $applicants,
        ]);
    }

    public function assignTrainingBatch()
    {
        if (empty($this->selectedIds)) {
            session()->flash('error', 'Please select at least one application.');
            return;
        }

        $selectedApplications = LearnerTrainingApplication::whereIn('id', $this->selectedIds)->get();

        // Check if any already have a batch assigned
        foreach ($selectedApplications as $application) {
            if ($application->training_batch_id) {
                session()->flash('error', 'One or more selected applications already have a batch assigned. Please deselect those before proceeding.');
                return;
            }
        }

        // Ensure all selected applications belong to the same course and center
        $uniqueCourses = $selectedApplications->pluck('training_course_id')->unique();
        $uniqueCenters = $selectedApplications->pluck('center_id')->unique();

        if ($uniqueCourses->count() > 1 || $uniqueCenters->count() > 1) {
            session()->flash('error', 'All selected applications must belong to the same training course and center.');
            return;
        }

        // Safe to extract — all applications share the same course and center
        $this->trainingCourseId = $uniqueCourses->first();
        $this->trainingCenterId = $uniqueCenters->first();


        // Load available batches for this course + center
        $this->trainingBatches = TrainingBatch::query()
            ->where('training_course_id', $this->trainingCourseId)
            ->where('center_id', $this->trainingCenterId)
            ->whereIn('status', ['open'])
            ->get();

        if ($this->trainingBatches->isEmpty()) {
            session()->flash('error', 'No available batches found for the selected course and center.');
            return;
        }

        $this->openAssignBatchModal = true;
    }

    public function confirmBatchAssignment()
    {
        $this->validate(['trainingBatchId' => 'required|exists:training_batches,id']);

        $selectedApplications = LearnerTrainingApplication::whereIn('id', $this->selectedIds)->get();

        // Update all selected applications with the batch
        LearnerTrainingApplication::whereIn('id', $this->selectedIds)
            ->update(
                [
                    'training_batch_id' => $this->trainingBatchId,
                    'status' => 'approved',
                ]
            );

        $trainingBatchStudentRepository = new TrainingBatchStudentRepository();

        // Each selected application may belong to a different learner, so loop through them
        foreach ($selectedApplications as $application) {
            // Check if learner is already enrolled in this batch to avoid duplicates
            $alreadyEnrolled = TrainingBatchStudent::where('training_batch_id', $this->trainingBatchId)
                ->where('user_id', $application->user_id)
                ->exists();

            if (!$alreadyEnrolled) {
                $trainingBatchStudentRepository->create([
                    'training_batch_id' => $this->trainingBatchId,
                    'user_id'           => $application->user_id,
                    'enrollment_date'   => now()->toDateString(),
                    'enrollment_status' => 'enrolled',
                ]);
            }
        }

        // Reset state
        $this->openAssignBatchModal = false;

        $this->selectedIds = [];

        $this->trainingBatchId = null;
        $this->trainingCourseId = null;
        $this->trainingCenterId = null;

        $this->trainingCourses = [];
        $this->trainingBatches = [];
        $this->trainingCenters = [];

        session()->flash('success', 'Batch assigned successfully to the selected applications.');
    }
}
