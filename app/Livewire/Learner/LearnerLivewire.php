<?php

namespace App\Livewire\Learner;

use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class LearnerLivewire extends Component
{
    use WithFileUploads;

    public $learner;
    public $isEditMode = true;

    // Basic Information
    public $uli;
    public $picture;
    public $currentPicturePath;
    public $school_name;
    public $school_address;
    public $client_type;
    public $registration_type = 'onsite';

    // Personal Information (Encrypted)
    public $sex;
    public $civil_status;
    public $birth_date;
    public $birth_place;
    public $mother_name;
    public $father_name;

    // Address Information (Encrypted)
    public $address_number_street;
    public $address_barangay;
    public $address_district;
    public $address_city;
    public $address_province;
    public $address_region;
    public $address_zip_code;

    // Contact Information (Encrypted)
    public $contact_mobile;
    public $contact_tel;
    public $contact_email;
    public $contact_fax;
    public $contact_others;

    // Educational Background
    public $educational_attainment;
    public $educational_attainment_others;

    // Employment Information
    public $employment_status;

    // JSON Fields
    public $work_experiences = [];
    public $trainings = [];
    public $licensure_examination = [];
    public $competency_assessment = [];

    public $documents = [];
    public $existingDocumentIds = [];

    public bool $agreedToTerms = false;


    public function mount(User $learner)
    {
        if ($learner) {
            $this->learner = $learner;
            $this->isEditMode = true;
            $this->loadLearnerData();
        } else {
            $this->initializeEmptyArrays();
        }
    }

    protected function loadLearnerData()
    {
        $this->uli = $this->learner->uli;
        $this->currentPicturePath       = $this->learner->picture_path;
        $this->school_name = $this->learner->school_name;
        $this->school_address = $this->learner->school_address;
        $this->client_type = $this->learner->client_type;
        $this->registration_type = $this->learner->registration_type;

        $this->sex = $this->learner->sex;
        $this->civil_status = $this->learner->civil_status;
        $this->birth_date = $this->learner->birth_date;
        $this->birth_place = $this->learner->birth_place;
        $this->mother_name = $this->learner->mother_name;
        $this->father_name = $this->learner->father_name;

        $this->address_number_street = $this->learner->address_number_street;
        $this->address_barangay = $this->learner->address_barangay;
        $this->address_district = $this->learner->address_district;
        $this->address_city = $this->learner->address_city;
        $this->address_province = $this->learner->address_province;
        $this->address_region = $this->learner->address_region;
        $this->address_zip_code = $this->learner->address_zip_code;

        $this->contact_mobile = $this->learner->contact_mobile;
        $this->contact_tel = $this->learner->contact_tel;
        $this->contact_email = $this->learner->email;
        $this->contact_fax = $this->learner->contact_fax;
        $this->contact_others = $this->learner->contact_others;

        $this->educational_attainment = $this->learner->educational_attainment;
        $this->educational_attainment_others = $this->learner->educational_attainment_others;

        $this->employment_status = $this->learner->employment_status;

        $this->work_experiences = $this->learner->work_experiences ? json_decode($this->learner->work_experiences, true) : [];
        $this->trainings = $this->learner->trainings ? json_decode($this->learner->trainings, true) : [];
        $this->licensure_examination = $this->learner->licensure_examination ? json_decode($this->learner->licensure_examination, true) : [];
        $this->competency_assessment = $this->learner->competency_assessment ? json_decode($this->learner->competency_assessment, true) : [];

        // Load documents separately
        $userDocuments = UserDocument::where('user_id', $this->learner->id)->get();
        $this->documents = $userDocuments->toArray();
        $this->existingDocumentIds = $userDocuments->pluck('id')->toArray();

        $this->agreedToTerms = $this->learner->agreed_to_terms;
    }

    protected function initializeEmptyArrays()
    {
        $this->work_experiences = [];
        $this->trainings = [];
        $this->licensure_examination = [];
        $this->competency_assessment = [];
        $this->documents = [];
    }

    // Document Methods
    public function addDocument()
    {
        $this->documents[] = [
            'type' => '',
            'file' => null
        ];
    }

    public function removeDocument($index)
    {
        $document = $this->documents[$index];

        // If it has an ID, it's an existing DB record — delete file from S3 and DB
        if (!empty($document['id'])) {
            $userDocument = UserDocument::find($document['id']);

            if ($userDocument) {
                // Delete file from S3 if it exists
                if ($userDocument->file && Storage::disk('s3')->exists($userDocument->file)) {
                    Storage::disk('s3')->delete($userDocument->file);
                }

                $userDocument->delete();
            }
        }

        unset($this->documents[$index]);
        $this->documents = array_values($this->documents);
    }

    // Work Experience Methods
    public function addWorkExperience()
    {
        $this->work_experiences[] = [
            'company' => '',
            'position' => '',
            'duration' => '',
            'responsibilities' => ''
        ];
    }

    public function removeWorkExperience($index)
    {
        unset($this->work_experiences[$index]);
        $this->work_experiences = array_values($this->work_experiences);
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
        $this->licensure_examination[] = [
            'title' => '',
            'license_number' => '',
            'date_taken' => '',
            'validity' => ''
        ];
    }

    public function removeLicensure($index)
    {
        unset($this->licensure_examination[$index]);
        $this->licensure_examination = array_values($this->licensure_examination);
    }

    // Competency Assessment Methods
    public function addCompetency()
    {
        $this->competency_assessment[] = [
            'qualification' => '',
            'certificate_number' => '',
            'date_issued' => '',
            'expiry_date' => ''
        ];
    }

    public function removeCompetency($index)
    {
        unset($this->competency_assessment[$index]);
        $this->competency_assessment = array_values($this->competency_assessment);
    }

    public function save()
    {
        try {

            $documentRules = [];
            foreach ($this->documents as $index => $document) {

                $isNewFile = isset($document['file']) &&
                    $document['file'] instanceof TemporaryUploadedFile;

                if ($isNewFile) {
                    $documentRules["documents.{$index}.file"] =
                        'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240';
                }
            }

            $this->validate(array_merge([

                'picture' => 'nullable|image|max:2048',
                'school_name' => 'nullable|string|max:255',
                'school_address' => 'nullable|string',
                'client_type' => 'nullable|in:tvet_graduating_student,tvet_graduate,industry_worker,k12,owf',
                'registration_type' => 'required|in:online,onsite',

                'sex' => 'nullable|in:male,female',
                'civil_status' => 'nullable|in:single,married,widow,separated',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'father_name' => 'nullable|string|max:255',

                'address_number_street' => 'nullable|string',
                'address_barangay' => 'nullable|string|max:255',
                'address_district' => 'nullable|string|max:255',
                'address_city' => 'nullable|string|max:255',
                'address_province' => 'nullable|string|max:255',
                'address_region' => 'nullable|string|max:255',
                'address_zip_code' => 'nullable|string|max:10',

                'contact_mobile' => 'nullable|string|max:255',
                'contact_tel' => 'nullable|string|max:255',
                'contact_email' => 'nullable|email|max:255',
                'contact_fax' => 'nullable|string|max:255',
                'contact_others' => 'nullable|string',

                'educational_attainment' => 'nullable|in:elementary_graduate,high_school_graduate,tvet_graduate,college_level,college_graduate,others',
                'educational_attainment_others' => 'nullable|string|max:255',
                'employment_status' => 'nullable|in:casual,job_order,probationary,permanent,self_employed,ofw',

                'work_experiences' => 'nullable|array',
                'work_experiences.*.company' => 'nullable|string|max:255',
                'work_experiences.*.position' => 'nullable|string|max:255',
                'work_experiences.*.duration' => 'nullable|string|max:255',
                'work_experiences.*.responsibilities' => 'nullable|string',

                'trainings' => 'nullable|array',
                'trainings.*.title' => 'nullable|string|max:255',
                'trainings.*.provider' => 'nullable|string|max:255',
                'trainings.*.date' => 'nullable|string|max:255',
                'trainings.*.hours' => 'nullable|string|max:255',

                'licensure_examination' => 'nullable|array',
                'licensure_examination.*.title' => 'nullable|string|max:255',
                'licensure_examination.*.license_number' => 'nullable|string|max:255',
                'licensure_examination.*.date_taken' => 'nullable|string|max:255',
                'licensure_examination.*.validity' => 'nullable|string|max:255',

                'competency_assessment' => 'nullable|array',
                'competency_assessment.*.qualification' => 'nullable|string|max:255',
                'competency_assessment.*.certificate_number' => 'nullable|string|max:255',
                'competency_assessment.*.date_issued' => 'nullable|string|max:255',
                'competency_assessment.*.expiry_date' => 'nullable|string|max:255',

                'agreedToTerms' => 'accepted',

            ], $documentRules), [

                'picture.image' => 'The file must be an image.',
                'picture.max' => 'The picture size must not exceed 2MB.',
                'registration_type.required' => 'The registration type is required.',
                'registration_type.in' => 'Please select a valid registration type.',
                'agreedToTerms.accepted' => 'You must agree to the certification statement before submitting.',
                'documents.*.file.mimes' => 'The document must be a file of type: jpg, jpeg, png, pdf.',
                'documents.*.file.max' => 'The document must not exceed 10MB.',

            ]);

            DB::transaction(function () {

                if ($this->picture instanceof TemporaryUploadedFile) {

                    if ($this->isEditMode && $this->learner?->picture_path) {
                        Storage::disk('s3')->delete($this->learner->picture_path);
                    }

                    $picturePath = $this->picture->store('profile-pictures', 's3');
                } else {
                    $picturePath = $this->isEditMode
                        ? $this->learner->picture_path
                        : null;
                }

                $data = [
                    'uli' => $this->uli,
                    'school_name' => $this->school_name,
                    'school_address' => $this->school_address,
                    'client_type' => $this->client_type,
                    'registration_type' => $this->registration_type,
                    'picture_path' => $picturePath,

                    'sex' => $this->sex,
                    'civil_status' => $this->civil_status,
                    'birth_date' => $this->birth_date,
                    'birth_place' => $this->birth_place,
                    'mother_name' => $this->mother_name,
                    'father_name' => $this->father_name,

                    'address_number_street' => $this->address_number_street,
                    'address_barangay' => $this->address_barangay,
                    'address_district' => $this->address_district,
                    'address_city' => $this->address_city,
                    'address_province' => $this->address_province,
                    'address_region' => $this->address_region,
                    'address_zip_code' => $this->address_zip_code,

                    'contact_mobile' => $this->contact_mobile,
                    'contact_tel' => $this->contact_tel,
                    'contact_email' => $this->contact_email,
                    'contact_fax' => $this->contact_fax,
                    'contact_others' => $this->contact_others,

                    'educational_attainment' => $this->educational_attainment,
                    'educational_attainment_others' => $this->educational_attainment_others,
                    'employment_status' => $this->employment_status,

                    'work_experiences' => !empty($this->work_experiences) ? json_encode($this->work_experiences) : null,
                    'trainings' => !empty($this->trainings) ? json_encode($this->trainings) : null,
                    'licensure_examination' => !empty($this->licensure_examination) ? json_encode($this->licensure_examination) : null,
                    'competency_assessment' => !empty($this->competency_assessment) ? json_encode($this->competency_assessment) : null,

                    'agreed_to_terms' => $this->agreedToTerms,
                ];

                if ($this->isEditMode) {

                    $this->learner->update($data);

                    foreach ($this->documents as $document) {

                        $isNewFile = isset($document['file']) &&
                            $document['file'] instanceof TemporaryUploadedFile;

                        if ($isNewFile) {

                            $filePath = $document['file']->store('learner-documents', 's3');

                            if (isset($document['id'])) {

                                $existing = UserDocument::find($document['id']);

                                if ($existing && $existing->file) {
                                    Storage::disk('s3')->delete($existing->file);
                                }

                                $existing?->update([
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

                            UserDocument::where('id', $document['id'])
                                ->update(['type' => $document['type']]);
                        }
                    }

                    session()->flash('success', 'Learner information updated successfully!');
                } else {

                    $user = User::create($data);

                    foreach ($this->documents as $document) {

                        if (
                            isset($document['file']) &&
                            $document['file'] instanceof TemporaryUploadedFile
                        ) {

                            $filePath = $document['file']->store('learner-documents', 's3');

                            UserDocument::create([
                                'user_id' => $user->id,
                                'type' => $document['type'],
                                'file' => $filePath,
                            ]);
                        }
                    }

                    session()->flash('success', 'Learner registered successfully!');
                    redirect()->route('learners.index')->send();
                }
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            report($e);
            session()->flash('danger', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.learner.learner-livewire');
    }
}
