<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
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

    public function registerExistingApplication($uuid)
    {
        $userId = User::where('uuid', $uuid)->value('id');
        return view('application.register-existing-learner-application', compact('userId'));
    }

    public function registerApplicationNoBatch()
    {
        return view('application.application-list-no-batch');
    }

    public function updateRegisteredApplication($uuid)
    {
        return view('application.update-registered-learner-application', compact('uuid'));
    }

    public function listRegisteredApplicants()
    {
        return view('application.list-registered-applicants');
    }

    public function listForConfirmationApplication()
    {
        return view('application.for-confirmation-application');
    }

    public function listForConfirmationApplicationView($userUuid)
    {
        $learner = User::role('Student')->where('uuid', $userUuid)->firstOrFail();
        $documents = UserDocument::where('user_id', $learner->id)->get();

        return view('application.for-review-application', [
            'uli'                           => $learner->uli,
            'firstName'                     => $learner->name,
            'middleName'                    => $learner->middle_name,
            'lastName'                      => $learner->last_name,
            'suffix'                        => $learner->extension,
            'clientType'                    => $learner->client_type,
            'currentPicturePath'            => $learner->picture_path,

            'schoolName'                    => $learner->school_name,
            'schoolAddress'                 => $learner->school_address,

            'sex'                           => $learner->sex,
            'civilStatus'                   => $learner->civil_status,
            'birthDate'                     => $learner->birth_date,
            'birthPlace'                    => $learner->birth_place,
            'motherName'                    => $learner->mother_name,
            'fatherName'                    => $learner->father_name,

            'addressNumberStreet'           => $learner->address_number_street,
            'addressBarangay'               => $learner->address_barangay,
            'addressDistrict'               => $learner->address_district,
            'addressCity'                   => $learner->address_city,
            'addressProvince'               => $learner->address_province,
            'addressRegion'                 => $learner->address_region,
            'addressZipCode'                => $learner->address_zip_code,

            'contactMobile'                 => $learner->contact_mobile,
            'contactTel'                    => $learner->contact_tel,
            'contactEmail'                  => $learner->contact_email,
            'contactFax'                    => $learner->contact_fax,
            'contactOthers'                 => $learner->contact_others,

            'educationalAttainment'         => $learner->educational_attainment,
            'educationalAttainmentOthers'   => $learner->educational_attainment_others,

            'employmentStatus'              => $learner->employment_status,

            'workExperiences'               => json_decode($learner->work_experiences, true) ?? [],
            'trainings'                     => json_decode($learner->trainings, true) ?? [],
            'licensureExamination'          => json_decode($learner->licensure_examination, true) ?? [],
            'competencyAssessment'          => json_decode($learner->competency_assessment, true) ?? [],

            'documents'                     => $documents ?? [],
            'userUuid'                      => $userUuid
        ]);
    }

    public function confirmLearverApplication(Request $rquest, $userUuid)
    {
        dd("SSS");
        $learner = User::where('uuid', $userUuid)->firstOrFail();
        $learner->is_confirmed = 1;
        $learner->save();

        return redirect()->route('learner-training-applications.for.confirmation')->with('success', 'Learner Application Confirmed Successfully!');
    }
}
