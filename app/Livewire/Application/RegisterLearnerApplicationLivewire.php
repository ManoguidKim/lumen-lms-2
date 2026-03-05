<?php

namespace App\Livewire\Application;

use App\Http\Requests\CreateRegisterLearnerApplicationRequest;
use App\Models\User;
use App\Models\UserDocument;
use FPDF;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingCenterCourse;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Repositories\TrainingBatchRepository;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\CourseAdministration\Repositories\TrainingCourseRepository;
use Modules\Institution\Models\Center;
use Modules\Institution\Repositories\TrainingCenterRepository;

class RegisterLearnerApplicationLivewire extends Component
{
    use WithFileUploads;

    public $userId;

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

    public $documents = [];
    public $agreedToTerms = false;

    public function mount($userId = null)
    {
        $this->initializeEmptyArrays();
    }

    protected function initializeEmptyArrays()
    {
        $this->workExperiences = [];
        $this->trainings = [];
        $this->licensureExamination = [];
        $this->competencyAssessment = [];
        $this->documents = [];
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
        $baseRules = (new CreateRegisterLearnerApplicationRequest())->rules();

        // Add document validation dynamically
        foreach ($this->documents as $index => $document) {
            $baseRules["documents.{$index}.type"] = 'required|string';
            if (isset($document['file']) && $document['file'] instanceof TemporaryUploadedFile) {
                $baseRules["documents.{$index}.file"] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240';
            }
        }

        $validated = $this->validate(
            $baseRules,
            (new CreateRegisterLearnerApplicationRequest())->messages()
        );

        DB::transaction(function () use ($validated) {

            if ($this->picture instanceof TemporaryUploadedFile) {
                if ($this->currentPicturePath) {
                    Storage::disk('s3')->delete($this->currentPicturePath);
                }
                $picturePath = $this->picture->store('profile-pictures', 's3');
            } else {
                $picturePath = $this->currentPicturePath ?? null;
            }

            $data = [
                'name'                          => $validated['firstName'],
                'middle_name'                   => $validated['middleName'] ?? null,
                'last_name'                     => $validated['lastName'],
                'extension'                     => $validated['suffix'] ?? null,
                'email'                         => $validated['contactEmail'],
                'password'                      => Hash::make('password'),
                'picture_path'                  => $picturePath,
                'uli'                           => $validated['uli'],
                'first_name'                    => $validated['firstName'],
                'suffix'                        => $validated['suffix'] ?? null,
                'school_name'                   => $validated['scholName'] ?? null,
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
                'registration_type'             => $validated['registrationType'] ?? $this->registrationType,
                'work_experiences'              => isset($validated['workExperiences']) ? json_encode($validated['workExperiences']) : null,
                'trainings'                     => isset($validated['trainings']) ? json_encode($validated['trainings']) : null,
                'licensure_examination'         => isset($validated['licensureExamination']) ? json_encode($validated['licensureExamination']) : null,
                'competency_assessment'         => isset($validated['competencyAssessment']) ? json_encode($validated['competencyAssessment']) : null,
                'is_confirmed'                  => true,
                'agreed_to_terms'               => $validated['agreedToTerms'],
            ];

            $learner = User::create($data);
            $learner->assignRole('Student');

            foreach ($this->documents as $document) {
                if (isset($document['file']) && $document['file'] instanceof TemporaryUploadedFile) {
                    $filePath = $document['file']->store('learner-documents', 's3');
                    UserDocument::create([
                        'user_id' => $learner->id,
                        'type'    => $document['type'],
                        'file'    => $filePath,
                    ]);
                }
            }

            $applicationData = LearnerTrainingApplication::create([
                'user_id'            => $learner->id,
                'center_id'          => $this->centerId,
                'training_course_id' => $this->courseId,
                'training_batch_id'  => $this->batchId ?? null,
                'status'             => $this->batchId ? 'approved' : 'pending',
                'application_number' => 'APP-' . date('Y') . '-' . Str::random(16),
                'application_date'   => now()->format('Y-m-d'),
                'reviewed_by'        => auth()->user()->id,
                'reviewed_at'        => now(),
                'registration_type'  => 'onsite',
            ]);

            if ($this->batchId) {
                // Register in training batch student
                $trainingBatchStudentRepository = new TrainingBatchStudentRepository();
                $trainingBatchStudentRepository->create([
                    'training_batch_id'  => $this->batchId,
                    'user_id'            => $learner->id,
                    'enrollment_date'    => now()->format('Y-m-d'),
                    'enrollment_status'  => 'enrolled',
                ]);
            }

            $pdf      = $this->generateTesdaForm($learner->toArray(), $applicationData->toArray());
            $fileName = 'tesda_registration_' . $learner->id . '_' . time() . '.pdf';
            $tmpPath  = storage_path('app/temp/' . $fileName);

            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $pdf->Output('F', $tmpPath);

            // Upload TESDA PDF to S3
            $s3Path = Storage::disk('s3')->putFileAs(
                'tesda-forms',
                new File($tmpPath),
                $fileName
            );

            $learner->update(['tesda_form_path' => $s3Path]);

            // Cleanup temp file
            unlink($tmpPath);

            // Update batch status if full
            $this->updateBatchStatusIfFull($this->batchId);
        });

        // Redirect to list
        return redirect()->route('learner-applications-list.index')
            ->with('success', isset($this->batchId)
                ? 'Learner application registered successfully'
                : 'Learner application submitted successfully and waiting for training batch assignment');
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

        return view('livewire.application.register-learner-application-livewire');
    }
}
