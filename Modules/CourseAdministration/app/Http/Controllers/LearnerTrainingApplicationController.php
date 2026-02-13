<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateLearnerTrainingApplicationRequest;
use Modules\CourseAdministration\Repositories\LearnerTrainingApplicationRepository;
use Modules\CourseAdministration\Repositories\TrainingCourseRepository;
use Modules\Institution\Repositories\CenterRepository;

class LearnerTrainingApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $learnerTrainingApplicationRepository;

    public function __construct(LearnerTrainingApplicationRepository $learnerTrainingApplicationRepository)
    {
        $this->learnerTrainingApplicationRepository = $learnerTrainingApplicationRepository;
    }

    public function index()
    {
        return view('learner.application.training_application');
    }

    public function applicationsList()
    {
        return view('application.application-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('learner.application.create_training_application');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLearnerTrainingApplicationRequest $request) {}

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        return view('learner.application.update_training_application', ['uuid' => $uuid]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('courseadministration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    // Registration of new learner applications
    public function registerApplication()
    {
        return view('application.register-learner-application');
    }

    public function updateRegisteredApplication($uuid)
    {
        return view('application.update-registered-learner-application', compact('uuid'));
    }
}
