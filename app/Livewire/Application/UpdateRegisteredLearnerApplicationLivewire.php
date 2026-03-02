<?php

namespace App\Livewire\Application;

use App\Http\Requests\UpdateLearnerRequest;
use App\Http\Requests\UpdateRegisterLearnerApplicationRequest;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;

class UpdateRegisteredLearnerApplicationLivewire extends Component
{
    use WithFileUploads;

    public $learner = null;

    public $picture;
    public $currentPicturePath;
    public $schoolName;
    public $schoolAddress;
    public $clientType;

    // Personal Information
    public $uli;
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
    public $documents = [];

    // Course and Batch
    public $courseId;
    public $batchId;
    public $courses = [];
    public $batches = [];

    public function mount($uuid = null)
    {
        $this->learner = User::where('uuid', $uuid)->firstOrFail();

        $this->uli                     = $this->learner->uli;
        // Personal Info
        $this->firstName                = $this->learner->name;
        $this->middleName               = $this->learner->middle_name;
        $this->lastName                 = $this->learner->last_name;
        $this->suffix                   = $this->learner->extension;
        $this->sex                      = $this->learner->sex;
        $this->civilStatus              = $this->learner->civil_status;
        $this->birthDate                = $this->learner->birth_date;
        $this->birthPlace               = $this->learner->birth_place;

        // Contact Info
        $this->contactEmail             = $this->learner->contact_email;
        $this->contactTel               = $this->learner->contact_tel;
        $this->contactMobile            = $this->learner->contact_mobile;
        $this->contactFax               = $this->learner->contact_fax;
        $this->contactOthers            = $this->learner->contact_others;

        // Address
        $this->addressNumberStreet      = $this->learner->address_number_street;
        $this->addressBarangay          = $this->learner->address_barangay;
        $this->addressCity              = $this->learner->address_city;
        $this->addressDistrict          = $this->learner->address_district;
        $this->addressProvince          = $this->learner->address_province;
        $this->addressRegion            = $this->learner->address_region;
        $this->addressZipCode           = $this->learner->address_zip_code;

        // Education & Employment
        $this->clientType               = $this->learner->client_type;
        $this->educationalAttainment    = $this->learner->educational_attainment;
        $this->educationalAttainmentOthers = $this->learner->educational_attainment_others;
        $this->employmentStatus         = $this->learner->employment_status;

        // School
        $this->schoolName               = $this->learner->school_name;
        $this->schoolAddress            = $this->learner->school_address;

        // Family
        $this->motherName               = $this->learner->mother_name;
        $this->fatherName               = $this->learner->father_name;

        // Profile
        $this->uli                      = $this->learner->uli;

        $this->currentPicturePath       = $this->learner->picture_path;

        // JSON fields
        // JSON fields
        $this->workExperiences      = is_string($this->learner->work_experiences)
            ? json_decode($this->learner->work_experiences, true) ?? []
            : ($this->learner->work_experiences ?? []);

        $this->trainings            = is_string($this->learner->trainings)
            ? json_decode($this->learner->trainings, true) ?? []
            : ($this->learner->trainings ?? []);

        $this->licensureExamination = is_string($this->learner->licensure_examination)
            ? json_decode($this->learner->licensure_examination, true) ?? []
            : ($this->learner->licensure_examination ?? []);

        $this->competencyAssessment = is_string($this->learner->competency_assessment)
            ? json_decode($this->learner->competency_assessment, true) ?? []
            : ($this->learner->competency_assessment ?? []);

        $this->documents = UserDocument::where('user_id', $this->learner->id)->get()->toArray();
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

    // Documents
    public function addDocument()
    {
        $this->documents[] = [
            'type' => '',
            'file' => null
        ];
    }

    public function removeDocument($index)
    {
        unset($this->documents[$index]);
        $this->documents = array_values($this->documents);
    }

    public function save()
    {
        $rules = (new UpdateLearnerRequest())->rules();

        // Override email rule to ignore current learner
        $rules['contactEmail'] = [
            'nullable',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore($this->learner->id)
        ];

        $validated = $this->validate(
            $rules,
            (new UpdateLearnerRequest())->messages(),
        );

        // Handle picture upload
        if ($this->picture && is_object($this->picture)) {
            // ✅ Delete old picture from S3 if exists
            if ($this->currentPicturePath) {
                Storage::disk('s3')->delete($this->currentPicturePath);
            }

            // ✅ Store new picture to S3
            $picturePath = $this->picture->store('profile-pictures', 's3');
        } else {
            // No new upload — keep existing path
            $picturePath = $this->currentPicturePath ?? null;
        }

        $data = [
            'uli'                           => $validated['uli'] ?? null,
            'name'                          => $validated['firstName'],
            'middle_name'                   => $validated['middleName'] ?? null,
            'last_name'                     => $validated['lastName'],
            'extension'                     => $validated['suffix'] ?? null,
            'picture_path'                  => $picturePath ?? null,
            'email'                         => $validated['contactEmail'], // login email updated
            'school_name'                   => $validated['schoolName'] ?? null,
            'school_address'                => $validated['schoolAddress'] ?? null,
            'client_type'                   => $validated['clientType'] ?? null,
            'address_number_street'         => $validated['addressNumberStreet'] ?? null,
            'address_barangay'              => $validated['addressBarangay'] ?? null,
            'address_city'                  => $validated['addressCity'] ?? null,
            'address_district'              => $validated['addressDistrict'] ?? null,
            'address_province'              => $validated['addressProvince'] ?? null,
            'address_region'                => $validated['addressRegion'] ?? null,
            'address_zip_code'              => $validated['addressZipCode'] ?? null,
            'mother_name'                   => $validated['motherName'] ?? null,
            'father_name'                   => $validated['fatherName'] ?? null,
            'sex'                           => $validated['sex'],
            'civil_status'                  => $validated['civilStatus'],
            'contact_tel'                   => $validated['contactTel'] ?? null,
            'contact_mobile'                => $validated['contactMobile'] ?? null,
            'contact_email'                 => $validated['contactEmail'] ?? null,
            'contact_fax'                   => $validated['contactFax'] ?? null,
            'contact_others'                => $validated['contactOthers'] ?? null,
            'birth_date'                    => $validated['birthDate'],
            'birth_place'                   => $validated['birthPlace'] ?? null,
            'educational_attainment'        => $validated['educationalAttainment'] ?? null,
            'educational_attainment_others' => $validated['educationalAttainmentOthers'] ?? null,
            'employment_status'             => $validated['employmentStatus'] ?? null,
            'work_experiences'              => isset($validated['workExperiences']) ? json_encode($validated['workExperiences']) : null,
            'trainings'                     => isset($validated['trainings']) ? json_encode($validated['trainings']) : null,
            'licensure_examination'         => isset($validated['licensureExamination']) ? json_encode($validated['licensureExamination']) : null,
            'competency_assessment'         => isset($validated['competencyAssessment']) ? json_encode($validated['competencyAssessment']) : null,
        ];

        $this->learner->update($data);

        foreach ($this->documents as $document) {
            $isNewFile = isset($document['file']) && is_object($document['file']);

            if ($isNewFile) {
                $filePath = $document['file']->store('learner-documents', 's3');

                if (isset($document['id'])) {
                    UserDocument::where('id', $document['id'])->update([
                        'type' => $document['type'],
                        'file' => $filePath,
                    ]);
                } else {
                    UserDocument::create([
                        'user_id' => $this->learner->id,
                        'type' => $document['type'],
                        'file' => $filePath,
                    ]);
                }
            } elseif (isset($document['id'])) {
                UserDocument::where('id', $document['id'])->update([
                    'type' => $document['type'],
                ]);
            }
        }



        return redirect()->route('learner-training-applications.list.registered.applicants')
            ->with('success', 'Learner application updated successfully');
    }

    public function render()
    {
        return view('livewire.application.update-registered-learner-application-livewire');
    }
}
