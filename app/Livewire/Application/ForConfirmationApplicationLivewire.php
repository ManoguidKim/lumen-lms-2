<?php

namespace App\Livewire\Application;

use App\Models\User;
use Exception;
use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;

class ForConfirmationApplicationLivewire extends Component
{
    public $search = '';
    public $pageCount = 10;

    public function render()
    {
        $applicants = User::query()

            ->select('centers.name as center_name', 'training_courses.course_name', 'training_courses.course_code', 'learner_training_applications.*', 'users.full_name_searchable', 'training_batches.batch_name', 'training_batches.batch_code', 'users.uuid')
            // Joins
            ->leftjoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            ->leftjoin('training_batches', 'training_batches.id', '=', 'learner_training_applications.training_batch_id')
            // Filter by learner
            ->whereIn('learner_training_applications.status', ['pending', 'approved', 'cancelled'])
            ->where('users.is_confirmed', false)
            // Search filter
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('learner_training_applications.application_number', 'like', '%' . $this->search . '%')
                        ->orWhere('centers.name', 'like', '%' . $this->search . '%')
                        ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                        ->orWhere('users.full_name_searchable', 'like', '%' . $this->search . '%');
                });
            })

            ->orderByRaw("FIELD(learner_training_applications.status, 'pending', 'approved', 'cancelled')")
            ->paginate($this->pageCount);

        return view('livewire.application.for-confirmation-application-livewire', compact('applicants'));
    }

    public function approveApplication($applicationId)
    {
        try {
            $applciation = LearnerTrainingApplication::find($applicationId);
            User::where('id', $applciation->user_id)->update(['is_confirmed' => 1]);
            session()->flash('success', 'Application approved successfully');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
