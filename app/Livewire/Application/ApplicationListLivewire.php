<?php

namespace App\Livewire\Application;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;

class ApplicationListLivewire extends Component
{
    public $search = '';
    public $pageCount = 10;
    public $batches = [];
    public $selectedBatchId = null;
    public $applicationId = null;

    // Modals
    public $openModalOnlineApplication = false;

    public function toggleModalOnlineApplication($applicationId = null)
    {
        $this->openModalOnlineApplication = !$this->openModalOnlineApplication;
        if ($this->openModalOnlineApplication) {
            $this->applicationId = $applicationId;
            $this->batches = TrainingBatch::query()
                ->select(
                    'training_batches.id',
                    'training_batches.uuid',
                    'training_batches.batch_name',
                    'training_batches.batch_code',
                    'training_batches.start_date',
                    'training_batches.end_date',
                    'training_batches.status',
                    'training_batches.max_participants',
                    DB::raw('COUNT(training_batch_students.id) as registered_students_count')
                )
                ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')
                ->groupBy(
                    'training_batches.id',
                    'training_batches.uuid',
                    'training_batches.batch_name',
                    'training_batches.batch_code',
                    'training_batches.start_date',
                    'training_batches.end_date',
                    'training_batches.status',
                    'training_batches.max_participants'
                )
                ->where('status', 'open')
                ->get();
        } else {
            $this->applicationId = null;
        }
    }

    public function assignBatch()
    {
        try {
            $currentBatch = TrainingBatch::findOrFail($this->selectedBatchId);
            if ($currentBatch->status === 'full') {
                session()->flash('error', 'This batch is already full. Please select another batch.');
                return;
            }

            $learnerRegistration = LearnerTrainingApplication::findOrFail($this->applicationId);
            if ($learnerRegistration->training_batch_id) {
                session()->flash('error', 'This application has already been assigned to a batch.');
                return;
            }

            DB::transaction(function () use ($learnerRegistration, $currentBatch) {
                // Update learner application
                $learnerRegistration->update([
                    'status' => 'approved',
                    'training_batch_id' => $this->selectedBatchId,
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now()
                ]);

                // Add to training batch student
                TrainingBatchStudent::create([
                    'training_batch_id' => $this->selectedBatchId,
                    'user_id' => $learnerRegistration->user_id,
                    'enrollment_date' => date('Y-m-d'),
                    'enrollment_status' => 'enrolled'
                ]);

                // Get data in training batch student
                $totalCount = TrainingBatchStudent::where('training_batch_id')->count();

                if ($totalCount >= $currentBatch->max_applicants) {
                    $currentBatch->update(['status' => 'full']);
                }
            });

            session()->flash('success', 'Learner successfully assigned to batch.');
            $this->toggleModalOnlineApplication(null);
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found. Please try again.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while assigning the batch. Please try again.');
        }
    }

    public function render()
    {
        $applicants = User::query()

            ->select('centers.name as center_name', 'training_courses.course_name', 'training_courses.course_code', 'learner_training_applications.*', 'users.full_name_searchable', 'training_batches.batch_name', 'training_batches.batch_code')
            // Joins
            ->leftjoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            ->leftjoin('training_batches', 'training_batches.id', '=', 'learner_training_applications.training_batch_id')
            // Filter by learner
            ->whereIn('learner_training_applications.status', ['pending', 'approved'])
            // Search filter
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('learner_training_applications.application_number', 'like', '%' . $this->search . '%')
                        ->orWhere('centers.name', 'like', '%' . $this->search . '%')
                        ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                        ->orWhere('users.full_name_searchable', 'like', '%' . $this->search . '%');
                });
            })

            ->orderByRaw("FIELD(learner_training_applications.status, 'pending', 'approved')")
            ->paginate($this->pageCount);

        $totalAppplication = LearnerTrainingApplication::count();
        $totalApprovedAppplication = LearnerTrainingApplication::where('status', 'approved')->count();
        $totalPendingAppplication = LearnerTrainingApplication::where('status', 'pending')->count();
        $totalRejectedAppplication = LearnerTrainingApplication::where('status', 'rejected')->count();

        return view('livewire.application.application-list-livewire', [
            'applicants' => $applicants,
            'totalAppplication' => $totalAppplication,
            'totalApprovedAppplication' => $totalApprovedAppplication,
            'totalPendingAppplication' => $totalPendingAppplication,
            'totalRejectedAppplication' => $totalRejectedAppplication
        ]);
    }
}
