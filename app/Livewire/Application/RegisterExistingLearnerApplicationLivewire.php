<?php

namespace App\Livewire\Application;

use App\Http\Requests\CreateRegisterLearnerApplicationRequest;
use App\Http\Requests\UpdateRegisterLearnerApplicationRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\Institution\Models\Center;

class RegisterExistingLearnerApplicationLivewire extends Component
{
    use WithFileUploads;

    public $userId;
    public $user = null;

    public $centerId;
    public $centers = [];

    public $courseId;
    public $courses = [];

    public $batchId;
    public $batches = [];

    // Basic Information

    public $uli;
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
    public $registrationType = 'onsite';
    public $password = '';

    // JSON Fields
    public $workExperiences = [];
    public $trainings = [];
    public $licensureExamination = [];
    public $competencyAssessment = [];

    private function checkLearnerCurrentApplicationStatus($userId)
    {
        $existingApplication = LearnerTrainingApplication::where('user_id', $userId)
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
                return redirect()->route('learner-applications-list.index');
            }
        }
    }

    public function mount($userId = null)
    {
        $this->checkLearnerCurrentApplicationStatus($userId);
        $this->initializeEmptyArrays();

        $this->userId = $userId;
        $this->user = User::findOrFail($this->userId);

        $this->uli                     = $this->user->uli;
        // Personal Info
        $this->firstName                = $this->user->name;
        $this->middleName               = $this->user->middle_name;
        $this->lastName                 = $this->user->last_name;
        $this->suffix                   = $this->user->extension;
        $this->sex                      = $this->user->sex;
        $this->civilStatus              = $this->user->civil_status;
        $this->birthDate                = $this->user->birth_date;
        $this->birthPlace               = $this->user->birth_place;

        // Contact Info
        $this->contactEmail             = $this->user->contact_email;
        $this->contactTel               = $this->user->contact_tel;
        $this->contactMobile            = $this->user->contact_mobile;
        $this->contactFax               = $this->user->contact_fax;
        $this->contactOthers            = $this->user->contact_others;

        // Address
        $this->addressNumberStreet      = $this->user->address_number_street;
        $this->addressBarangay          = $this->user->address_barangay;
        $this->addressCity              = $this->user->address_city;
        $this->addressDistrict          = $this->user->address_district;
        $this->addressProvince          = $this->user->address_province;
        $this->addressRegion            = $this->user->address_region;
        $this->addressZipCode           = $this->user->address_zip_code;

        // Education & Employment
        $this->clientType               = $this->user->client_type;
        $this->educationalAttainment    = $this->user->educational_attainment;
        $this->educationalAttainmentOthers = $this->user->educational_attainment_others;
        $this->employmentStatus         = $this->user->employment_status;
        $this->registrationType         = $this->user->registration_type;

        // School
        $this->schoolName               = $this->user->school_name;
        $this->schoolAddress            = $this->user->school_address;

        // Family
        $this->motherName               = $this->user->mother_name;
        $this->fatherName               = $this->user->father_name;

        // Profile
        $this->uli                      = $this->user->uli;
        $this->currentPicturePath       = $this->user->picture_path;

        // JSON fields
        // JSON fields
        $this->workExperiences      = is_string($this->user->work_experiences)
            ? json_decode($this->user->work_experiences, true) ?? []
            : ($this->user->work_experiences ?? []);

        $this->trainings            = is_string($this->user->trainings)
            ? json_decode($this->user->trainings, true) ?? []
            : ($this->user->trainings ?? []);

        $this->licensureExamination = is_string($this->user->licensure_examination)
            ? json_decode($this->user->licensure_examination, true) ?? []
            : ($this->user->licensure_examination ?? []);

        $this->competencyAssessment = is_string($this->user->competency_assessment)
            ? json_decode($this->user->competency_assessment, true) ?? []
            : ($this->user->competency_assessment ?? []);
    }

    protected function initializeEmptyArrays()
    {
        $this->workExperiences = [];
        $this->trainings = [];
        $this->licensureExamination = [];
        $this->competencyAssessment = [];
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

    // Competency Assessment Methods
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
        $rules = (new UpdateRegisterLearnerApplicationRequest())->rules();

        // Override email rule to ignore current learner
        $rules['contactEmail'] = [
            'nullable',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore($this->user->id)
        ];

        $validated = $this->validate(
            $rules,
            (new UpdateRegisterLearnerApplicationRequest())->messages(),
        );

        $data = [
            'uli' => $validated['uli'],
            'name' => $validated['firstName'],
            'middle_name' => $validated['middleName'],
            'last_name' => $validated['lastName'],
            'extension' => $validated['suffix'],
            'email' => $validated['contactEmail'],
            'first_name' => $validated['firstName'],
            'middle_name' => $validated['middleName'] ?? null,
            'last_name' => $validated['lastName'],
            'suffix' => $validated['suffix'] ?? null,
            'current_picture_path' => $validated['currentPicturePath'] ?? null,
            'school_name' => $validated['scholName'] ?? null,
            'school_address' => $validated['schoolAddress'] ?? null,
            'client_type' => $validated['clientType'] ?? null,
            'address_number_street' => $validated['addressNumberStreet'] ?? null,
            'address_barangay' => $validated['addressBarangay'] ?? null,
            'address_city' => $validated['addressCity'] ?? null,
            'address_district' => $validated['addressDistrict'] ?? null,
            'address_province' => $validated['addressProvince'] ?? null,
            'address_region' => $validated['addressRegion'] ?? null,
            'address_zip_code' => $validated['addressZipCode'] ?? null,
            'mother_name' => $validated['motherName'] ?? null,
            'father_name' => $validated['fatherName'] ?? null,
            'sex' => $validated['sex'],
            'civil_status' => $validated['civilStatus'],
            'contact_tel' => $validated['contactTel'] ?? null,
            'contact_mobile' => $validated['contactMobile'] ?? null,
            'contact_email' => $validated['contactEmail'] ?? null,
            'contact_fax' => $validated['contactFax'] ?? null,
            'contact_others' => $validated['contactOthers'] ?? null,
            'birth_date' => $validated['birthDate'],
            'birth_place' => $validated['birthPlace'] ?? null,
            'educational_attainment' => $validated['educationalAttainment'] ?? null,
            'educational_attainment_others' => $validated['educationalAttainmentOthers'] ?? null,
            'employment_status' => $validated['employmentStatus'] ?? null,
            'registration_type' => $validated['registrationType'] ?? $this->registrationType,
            'work_experiences' => isset($validated['workExperiences']) ? json_encode($validated['workExperiences']) : null,
            'trainings' => isset($validated['trainings']) ? json_encode($validated['trainings']) : null,
            'licensure_examination' => isset($validated['licensureExamination']) ? json_encode($validated['licensureExamination']) : null,
            'competency_assessment' => isset($validated['competencyAssessment']) ? json_encode($validated['competencyAssessment']) : null,
            'is_confirmed' => 1
        ];
        $this->user->update($data);

        // Registration Data
        LearnerTrainingApplication::create([
            'user_id' => $this->userId,
            'center_id' => $this->centerId,
            'training_course_id' => $this->courseId,
            'training_batch_id' => $this->batchId ?? null,
            'status' => $this->batchId ? 'approved' : 'pending',
            'application_number' => 'APP-' . date('Y') . '-' . Str::random(16),
            'application_date' => date('Y-m-d'),
            'reviewed_by' => auth()->user()->id,
            'reviewed_at' => now(),
            'registration_type' => 'onsite'
        ]);

        if (isset($this->batchId)) {
            // Register in traing batch student
            $trainingBatchStudentRepository = new TrainingBatchStudentRepository();
            $trainingBatchStudentRepository->create([
                'training_batch_id' => $this->batchId,
                'user_id' => $this->userId,
                'enrollment_date' => date('Y-m-d'),
                'enrollment_status' => 'enrolled',
            ]);
        }

        // update batch status if max participants reached
        $this->updateBatchStatusIfFull($this->batchId);

        // Redirect to index
        if (isset($this->batchId)) {
            return redirect()->route('learner-applications-list.index')
                ->with('success', 'Learner application registered successfully');
        } else {
            return redirect()->route('learner-applications-list.index')
                ->with('success', 'Learner application submitted successfully and waiting for training batch assignment');
        }
    }

    private function updateBatchStatusIfFull($batchId)
    {
        $batch = TrainingBatch::query()
            ->select(
                'training_batches.id',
                'training_batches.max_participants',
                DB::raw('COUNT(training_batch_students.id) as registered_students_count')
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')
            ->where('training_batches.id', $batchId)
            ->groupBy(
                'training_batches.id',
                'training_batches.max_participants'
            )
            ->first();

        if ($batch) {
            if ($batch->registered_students_count >= $batch->max_participants && $batch->status !== 'full') {
                $batch->update(['status' => 'full']);
            }
        }
    }

    public function updatedCourseId()
    {
        $this->centerId = null;
        $this->batchId = null;
        $this->batches = [];
        $this->centers = [];
    }

    public function updatedCenterId()
    {
        $this->batchId = null;
        $this->batches = [];
    }

    public function render()
    {
        // Always load courses
        $this->courses = TrainingCourse::all();

        // Load centers that offer the selected course
        if ($this->courseId) {
            $this->centers = Center::query()
                ->join('training_center_courses', 'centers.id', '=', 'training_center_courses.center_id')
                ->where('training_center_courses.training_course_id', $this->courseId)
                ->where('training_center_courses.is_active', true)
                ->select('centers.*')
                ->get();
        }

        // Load batches for the selected course + center
        if ($this->courseId && $this->centerId) {
            $this->batches = TrainingBatch::query()
                ->where('training_course_id', $this->courseId)
                ->where('center_id', $this->centerId)
                ->whereIn('status', ['open', 'ongoing'])
                ->get();
        }

        return view('livewire.application.register-existing-learner-application-livewire');
    }
}
