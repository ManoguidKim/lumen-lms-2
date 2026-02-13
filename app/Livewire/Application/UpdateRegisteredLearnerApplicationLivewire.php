<?php

namespace App\Livewire\Application;

use App\Http\Requests\UpdateRegisterLearnerApplicationRequest;
use App\Models\User;
use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;

class UpdateRegisteredLearnerApplicationLivewire extends Component
{
    public $learner = null;

    public $picture;
    public $currentPicturePath;
    public $schoolName;
    public $schoolAddress;
    public $clientType;

    // Personal Information
    public $firstName;
    public $middleName;
    public $lastName;
    public $suffix;
    public $sex;
    public $civilStatus;
    public $birthDate;
    public $birthPlace;
    public $motherName;
    public $fatherName;

    // Address Information (Encrypted)
    public $addressNumberStreet;
    public $addressBarangay;
    public $addressDistrict;
    public $addressCity;
    public $addressProvince;
    public $addressRegion;
    public $addressZipCode;

    // Contact Information (Encrypted)
    public $contactMobile;
    public $contactTel;
    public $contactEmail;
    public $contactFax;
    public $contactOthers;

    // Educational Background
    public $educationalAttainment;
    public $educationalAttainmentOthers;

    // Employment Information
    public $employmentStatus;

    // JSON Fields
    public $workExperiences = [];
    public $trainings = [];
    public $licensureExamination = [];
    public $competencyAssessment = [];

    // Course and Batch
    public $courseId;
    public $batchId;
    public $courses = [];
    public $batches = [];

    public function mount($uuid = null)
    {
        $applicationDetails = LearnerTrainingApplication::where('uuid', $uuid)->first();
        $this->learner = User::findOrFail($applicationDetails->user_id);

        // File paths
        $this->picture = $this->learner->picture_path;
        $this->currentPicturePath = $this->learner->picture_path;

        // School Information
        $this->schoolName = $this->learner->name; // 'name' column
        $this->schoolAddress = $this->learner->school_address;
        $this->clientType = $this->learner->client_type;

        // Personal Information - CORRECTED MAPPING
        $this->firstName = $this->learner->name; // Use 'name' column (no first_name in DB)
        $this->middleName = $this->learner->middle_name;
        $this->lastName = $this->learner->last_name;
        $this->suffix = $this->learner->extension; // FIXED: 'extension' not 'suffix'
        $this->sex = $this->learner->sex; // 'sex' column doesn't exist, using uli or set to null
        $this->civilStatus = $this->learner->civil_status;
        $this->birthDate = $this->learner->birth_date;
        $this->birthPlace = $this->learner->birth_place;
        $this->motherName = $this->learner->mother_name;
        $this->fatherName = $this->learner->father_name;

        // Address Information (Encrypted fields)
        $this->addressNumberStreet = $this->learner->address_number_street;
        $this->addressBarangay = $this->learner->address_barangay;
        $this->addressDistrict = $this->learner->address_district;
        $this->addressCity = $this->learner->address_city;
        $this->addressProvince = $this->learner->address_province;
        $this->addressRegion = $this->learner->address_region;
        $this->addressZipCode = $this->learner->address_zip_code;

        // Contact Information (Encrypted fields)
        $this->contactMobile = $this->learner->contact_mobile;
        $this->contactTel = $this->learner->contact_tel;
        $this->contactEmail = $this->learner->email;
        $this->contactFax = $this->learner->contact_fax;
        $this->contactOthers = $this->learner->contact_others;

        // Educational Background
        $this->educationalAttainment = $this->learner->educational_attainment;
        $this->educationalAttainmentOthers = $this->learner->educational_attainment_others;

        // Employment Information
        $this->employmentStatus = $this->learner->employment_status;

        // JSON Fields (cast to array if null)
        $this->workExperiences = $this->learner->work_experiences ? json_decode($this->learner->work_experiences, true) : [];
        $this->trainings = $this->learner->trainings ? json_decode($this->learner->trainings, true) : [];
        $this->licensureExamination = $this->learner->licensure_examination ? json_decode($this->learner->licensure_examination, true) : [];
        $this->competencyAssessment = $this->learner->competency_assessment ? json_decode($this->learner->competency_assessment, true) : [];

        $this->courseId = $applicationDetails->training_course_id;
        $this->batchId = $applicationDetails->training_batch_id;

        // Load courses and batches for dropdowns
        $this->courses = TrainingCourse::all();
        $this->batches = TrainingBatch::all();
    }

    public function updatedCourseId($value)
    {
        // When course changes, reload batches for that course
        $this->batches = TrainingBatch::where('training_course_id', $value)->get();
        $this->batchId = ''; // Reset batch selection
    }

    // Work Experience Methods
    public function addWorkExperience()
    {
        $this->workExperiences[] = [
            'company' => '',
            'position' => '',
            'duration' => '',
            'responsibilities' => ''
        ];
    }

    public function removeWorkExperience($index)
    {
        unset($this->workExperiences[$index]);
        $this->workExperiences = array_values($this->workExperiences);
    }

    // Training Methods
    public function addTraining()
    {
        $this->trainings[] = [
            'title' => '',
            'provider' => '',
            'date' => '',
            'hours' => ''
        ];
    }

    public function removeTraining($index)
    {
        unset($this->trainings[$index]);
        $this->trainings = array_values($this->trainings);
    }

    // Licensure Methods
    public function addLicensure()
    {
        $this->licensureExamination[] = [
            'title' => '',
            'license_number' => '',
            'date_taken' => '',
            'validity' => ''
        ];
    }

    public function removeLicensure($index)
    {
        unset($this->licensureExamination[$index]);
        $this->licensureExamination = array_values($this->licensureExamination);
    }

    // Competency Methods
    public function addCompetency()
    {
        $this->competencyAssessment[] = [
            'qualification' => '',
            'certificate_number' => '',
            'date_issued' => '',
            'expiry_date' => ''
        ];
    }

    public function removeCompetency($index)
    {
        unset($this->competencyAssessment[$index]);
        $this->competencyAssessment = array_values($this->competencyAssessment);
    }

    public function save()
    {
        $validated = $this->validate(
            (new UpdateRegisterLearnerApplicationRequest())->rules(),
            (new UpdateRegisterLearnerApplicationRequest())->messages(),
        );

        $this->learner->update([
            'name' => $validated['firstName'],
            'middle_name' => $validated['middleName'],
            'last_name' => $validated['lastName'],
            'extension' => $validated['suffix'],
            'civil_status' => $validated['civilStatus'],
            'birth_date' => $validated['birthDate'],
            'birth_place' => $validated['birthPlace'],
            'mother_name' => $validated['motherName'],
            'father_name' => $validated['fatherName'],
            'address_number_street' => $validated['addressNumberStreet'],
            'address_barangay' => $validated['addressBarangay'],
            'address_district' => $validated['addressDistrict'],
            'address_city' => $validated['addressCity'],
            'address_province' => $validated['addressProvince'],
            'address_region' => $validated['addressRegion'],
            'address_zip_code' => $validated['addressZipCode'],
            'contact_mobile' => $validated['contactMobile'],
            'contact_tel' => $validated['contactTel'],
            'contact_fax' => $validated['contactFax'],
            'contact_others' => $validated['contactOthers'],
            'educational_attainment' => $validated['educationalAttainment'],
            'educational_attainment_others' => $validated['educationalAttainmentOthers'],
            'employment_status' => $validated['employmentStatus'],
            'work_experiences' => json_encode($this->workExperiences),
            'trainings' => json_encode($this->trainings),
            'licensure_examination' => json_encode($this->licensureExamination),
            'competency_assessment' => json_encode($this->competencyAssessment),
        ]);

        // Redirect to index
        return redirect()->route('learner-applications-list.index')
            ->with('success', 'Learner application updated successfully');
    }

    public function render()
    {
        return view('livewire.application.update-registered-learner-application-livewire');
    }
}
