<?php

namespace App\Livewire\Application;

use App\Models\User;
use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;

class ApplicationListLivewire extends Component
{
    public $search = '';
    public $pageCount = 10;

    public function render()
    {
        $applicants = User::query()

            ->select('centers.name as center_name', 'training_courses.course_name', 'training_courses.course_code', 'learner_training_applications.*', 'users.name', 'users.middle_name', 'users.last_name')
            // Joins
            ->leftjoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            // Filter by learner
            ->whereIn('learner_training_applications.status', ['pending', 'approved'])
            // Search filter
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('learner_training_applications.application_number', 'like', '%' . $this->search . '%')
                        ->orWhere('centers.name', 'like', '%' . $this->search . '%')
                        ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                        ->orWhere('learner_training_applications.status', 'like', '%' . $this->search . '%');
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
