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
        $validated = $this->validate(
            (new CreateRegisterLearnerApplicationRequest())->rules(),
            (new CreateRegisterLearnerApplicationRequest())->messages(),
        );

        $documentRules = [];
        foreach ($this->documents as $index => $document) {
            $isNewFile = isset($document['file']) && is_object($document['file']);
            if ($isNewFile) {
                $documentRules["documents.{$index}.file"] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240';
            }
        }

        // Handle picture upload
        if ($this->picture) {
            // Delete old picture from S3 if exists
            if ($this->currentPicturePath) {
                Storage::disk('s3')->delete($this->currentPicturePath);
            }

            // Store new picture to S3
            $picturePath = $this->picture->store('profile-pictures', 's3');
        } else {
            $picturePath = $this->currentPicturePath ?? null;
        }

        $data = [
            'name' => $validated['firstName'],
            'middle_name' => $validated['middleName'],
            'last_name' => $validated['lastName'],
            'extension' => $validated['suffix'],
            'email' => $validated['contactEmail'],
            'password' => Hash::make('password'),
            'uli' => $validated['uli'],
            'first_name' => $validated['firstName'],
            'middle_name' => $validated['middleName'] ?? null,
            'last_name' => $validated['lastName'],
            'suffix' => $validated['suffix'] ?? null,
            'picture_path' => $picturePath ?? null,
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
            'is_confirmed' => true,
            'agreed_to_terms' => $validated['agreedToTerms']
        ];
        $currentRegiterLearner = User::create($data);

        if ($currentRegiterLearner) {
            foreach ($this->documents as $document) {
                if (isset($document['file']) && is_object($document['file'])) {
                    $filePath = $document['file']->store('learner-documents', 's3');
                    UserDocument::create([
                        'user_id' => $currentRegiterLearner->id,
                        'type' => $document['type'],
                        'file' => $filePath,
                    ]);
                }
            }

            // Print Tesda form
            $pdf      = $this->generateTesdaForm($currentRegiterLearner->toArray(), $applicationData->toArray());
            $fileName = 'tesda_registration_' . $currentRegiterLearner->id . '_' . time() . '.pdf';
            $tmpPath  = storage_path('app/temp/' . $fileName);

            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $pdf->Output('F', $tmpPath);

            // Upload to S3
            $s3Path = Storage::disk('s3')->putFileAs(
                'tesda-forms',
                new File($tmpPath),
                $fileName
            );

            // Save S3 path to user record
            $currentRegiterLearner->update(['tesda_form_path' => $s3Path]);

            // Clean up temp file
            unlink($tmpPath);
        }

        $currentRegiterLearner->assignRole('Student');

        // Registration Data
        $applicationData = LearnerTrainingApplication::create([
            'user_id' => $currentRegiterLearner->id,
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
                'user_id' => $currentRegiterLearner->id,
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

        return view('livewire.application.register-learner-application-livewire');
    }

    private function generateTesdaForm(array $learner, array $application = []): FPDF
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetMargins(10, 10);
        $pdf->SetAutoPageBreak(false);

        // ── constants ────────────────────────────────────────────────────────────
        $lm = 10;   // left margin
        $cw = 190;  // content width (210 - 2*10)

        // ── closures ─────────────────────────────────────────────────────────────
        $val = fn($key) => isset($learner[$key]) && $learner[$key] !== null
            ? (string) $learner[$key] : '';

        $sectionHeader = function (string $title, float $y) use ($pdf, $lm, $cw) {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(200, 200, 200);
            $pdf->SetXY($lm, $y);
            $pdf->Cell($cw, 5, $title, 1, 1, 'L', true);
            $pdf->SetFillColor(255, 255, 255);
        };

        // draws a checkbox square + label to its right
        $checkRow = function (
            float $x,
            float $y,
            string $label,
            bool $checked,
            float $fs = 6
        ) use ($pdf) {
            $b = 3.2; // box size
            $pdf->Rect($x, $y + 0.5, $b, $b);
            if ($checked) {
                // draw an X inside
                $pdf->Line($x, $y + 0.5, $x + $b, $y + 0.5 + $b);
                $pdf->Line($x + $b, $y + 0.5, $x, $y + 0.5 + $b);
            }
            $pdf->SetFont('Arial', '', $fs);
            $pdf->SetXY($x + $b + 1, $y + 0.3);
            $pdf->Cell(55, $b + 0.5, $label, 0, 0);
        };

        $calcAge = function (string $d): string {
            if (!$d) return '';
            try {
                return (string)(new \DateTime($d))->diff(new \DateTime())->y;
            } catch (\Exception $e) {
                return '';
            }
        };

        // ══════════════════════════════════════════════════════════════════════════
        // PAGE 1
        // ══════════════════════════════════════════════════════════════════════════
        $pdf->AddPage();

        // ── header ────────────────────────────────────────────────────────────────
        $misW = 28;
        $textW = $cw - $misW - 2;

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY($lm, 8);
        $pdf->Cell($textW, 4, 'Technical Education and Skills Development Authority', 0, 2, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetX($lm);
        $pdf->Cell($textW, 4, 'Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad ng Kasanayan', 0, 0, 'C');

        // MIS box — top right
        $misX = $lm + $textW + 2;
        $pdf->Rect($misX, 7, $misW, 10);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($misX, 8);
        $pdf->Cell($misW, 4, 'MIS 03-01', 0, 2, 'C');
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetX($misX);
        $pdf->Cell($misW, 4, '(ver. 2021)', 0, 0, 'C');

        // ── title bar ─────────────────────────────────────────────────────────────
        $pdf->SetXY($lm, 19);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell($cw, 7, 'Registration Form', 1, 2, 'C');

        // ── sub-title + ID picture box ─────────────────────────────────────────
        $picW = 33;
        $picH = 22;
        $picX = $lm + $cw - $picW;
        $picY = 27;
        $pdf->Rect($picX, $picY, $picW, $picH);
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($picX, $picY + 8);
        $pdf->Cell($picW, 4, 'I.D. Picture', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY($lm, 28);
        $pdf->Cell($cw - $picW - 2, 6, 'LEARNERS PROFILE FORM', 0, 0, 'L');

        // ══════════════════════════════════════════════════════════════════════════
        // SECTION 1 – T2MIS
        // ══════════════════════════════════════════════════════════════════════════
        $y = 51;
        $sectionHeader('1. T2MIS Auto Generated', $y);
        $y += 6;

        // label | ULI box | entry date label | entry date box  — all on ONE row
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $uliLabelW = 56;
        $pdf->Cell($uliLabelW, 5, '1.1. Unique Learner Identifier Number:', 0, 0, 'L');

        $uliBoxW = 78;
        $pdf->Rect($lm + $uliLabelW, $y, $uliBoxW, 5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + $uliLabelW + 1, $y);
        $pdf->Cell($uliBoxW - 2, 5, $val('uli'), 0, 0, 'C');

        $edLabelW = 22;
        $edBoxW   = $cw - $uliLabelW - $uliBoxW - $edLabelW;
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm + $uliLabelW + $uliBoxW, $y);
        $pdf->Cell($edLabelW, 5, '1.2. Entry Date:', 0, 0, 'R');

        $edX = $lm + $uliLabelW + $uliBoxW + $edLabelW;
        $pdf->Rect($edX, $y, $edBoxW, 5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($edX + 1, $y);
        $pdf->Cell($edBoxW - 2, 5, date('Y-m-d', strtotime($application['application_date'])), 0, 0, 'C');
        $y += 7;

        // ══════════════════════════════════════════════════════════════════════════
        // SECTION 2 – Learner/Manpower Profile
        // ══════════════════════════════════════════════════════════════════════════
        $sectionHeader('2. Learner/Manpower Profile', $y);
        $y += 6;

        // ── 2.1 Name ─────────────────────────────────────────────────────────────
        // Layout: [label 22mm] | [Last Name box] | [First box] | [Middle box]
        // Each box has a data row (7mm) + a sub-label row (3.5mm) below it
        $nameLabelW = 22;
        $lastName   = trim($val('last_name') . ($val('suffix') ? ', ' . $val('suffix') : ''));
        $firstName  = $val('first_name');
        $middleName = $val('middle_name');

        // Equal thirds for the 3 name boxes
        $nameRemainder = $cw - $nameLabelW;
        $nameColW = $nameRemainder / 3; // each box same width

        $nDataH  = 7;   // height of the data box
        $nLabelH = 3.5; // height of the sub-label underneath
        $nTotalH = $nDataH + $nLabelH;

        // "2.1 Name:" label — vertically centred against the data box only
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y + ($nDataH / 2) - 2);
        $pdf->Cell($nameLabelW, 5, '2.1  Name:', 0, 0, 'L');

        // x positions of the 3 boxes
        $x1 = $lm + $nameLabelW;
        $x2 = $x1 + $nameColW;
        $x3 = $x2 + $nameColW;

        // draw 3 data boxes
        $pdf->Rect($x1, $y, $nameColW, $nDataH);
        $pdf->Rect($x2, $y, $nameColW, $nDataH);
        $pdf->Rect($x3, $y, $nameColW, $nDataH);

        // fill values — centred vertically and horizontally inside each box
        $pdf->SetFont('Arial', '', 8);
        foreach ([[$x1, $lastName], [$x2, $firstName], [$x3, $middleName]] as [$bx, $bv]) {
            $pdf->SetXY($bx + 1, $y + 1);
            $pdf->Cell($nameColW - 2, $nDataH - 2, $bv, 0, 0, 'C');
        }

        // sub-labels BELOW each box (italic, small)
        $subY = $y + $nDataH;
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->SetXY($x1, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'Last Name, Extension Name (Jr., Sr.)', 0, 0, 'C');
        $pdf->SetXY($x2, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'First', 0, 0, 'C');
        $pdf->SetXY($x3, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'Middle', 0, 0, 'C');

        $y += $nTotalH + 3; // move y past name block + small gap

        // ── 2.2 Complete Permanent Mailing Address ────────────────────────────────
        // Layout:
        //   LEFT:  "2.2 Complete Permanent Mailing Address:" label (28mm wide)
        //   RIGHT: 3 rows × 3 columns of boxes, each box has data (6mm) + sub-label (3.5mm)
        //
        //   Row 1: Number/Street | Barangay       | District
        //   Row 2: City/Muni     | Province       | Region
        //   Row 3: Email         | Contact No     | Nationality

        $addrLabelW = 28;
        $addrW      = $cw - $addrLabelW;
        $aColW      = $addrW / 3;
        $aDataH     = 6;    // box data height
        $aSubH      = 3.5;  // sub-label height
        $aRowH      = $aDataH + $aSubH; // total per row

        $addrTop = $y;
        $addrTotalH = $aRowH * 3;

        // "2.2 Complete Permanent Mailing Address:" label — plain text, no MultiCell wrapping
        $pdf->SetFont('Arial', 'B', 8);
        // Line 1
        $pdf->SetXY($lm, $addrTop + 0);
        $pdf->Cell($addrLabelW, 5, '2.2  Complete', 0, 0, 'L');
        // Line 2
        $pdf->SetXY($lm, $addrTop + 5);
        $pdf->Cell($addrLabelW, 5, 'Permanent', 0, 0, 'L');
        // Line 3
        $pdf->SetXY($lm, $addrTop + 10);
        $pdf->Cell($addrLabelW, 5, 'Mailing', 0, 0, 'L');
        // Line 4
        $pdf->SetXY($lm, $addrTop + 15);
        $pdf->Cell($addrLabelW, 5, 'Address:', 0, 0, 'L');

        // Helper: draw one address row (data boxes + sub-labels)
        $drawAddrRow = function (
            float $rowY,
            array $fields  // [ field_key => 'Sub-label text', ... ]  — 3 entries
        ) use ($pdf, $lm, $addrLabelW, $aColW, $aDataH, $aSubH, $val) {
            $ax = $lm + $addrLabelW;
            foreach ($fields as $field => $sublabel) {
                // data box
                $pdf->Rect($ax, $rowY, $aColW, $aDataH);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY($ax + 1, $rowY + 1);
                $pdf->Cell($aColW - 2, $aDataH - 2, $val($field), 0, 0, 'L');
                // sub-label BELOW the box
                $pdf->SetFont('Arial', 'I', 6);
                $pdf->SetXY($ax, $rowY + $aDataH);
                $pdf->Cell($aColW, $aSubH, $sublabel, 0, 0, 'C');
                $ax += $aColW;
            }
        };

        $drawAddrRow($addrTop, [
            'address_number_street' => 'Number, Street',
            'address_barangay'      => 'Barangay',
            'address_district'      => 'District',
        ]);

        $drawAddrRow($addrTop + $aRowH, [
            'address_city'     => 'City/Municipality',
            'address_province' => 'Province',
            'address_region'   => 'Region',
        ]);

        $drawAddrRow($addrTop + $aRowH * 2, [
            'contact_email'  => 'Email Address/Facebook Account:',
            'contact_mobile' => 'Contact No:',
            'nationality'    => 'Nationality',
        ]);

        $y = $addrTop + $addrTotalH + 4;

        // ══════════════════════════════════════════════════════════════════════════
        // SECTION 3 – Personal Information
        // ══════════════════════════════════════════════════════════════════════════
        $sectionHeader('3. Personal Information', $y);
        $y += 5;

        // column widths
        $col1W = 33;
        $col2W = 52;
        $col3W = $cw - $col1W - $col2W;

        // column headers
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($col1W, 4, '3.1  Sex', 'B', 0, 'L');
        $pdf->Cell($col2W, 4, '3.2.  Civil Status', 'B', 0, 'L');
        $pdf->Cell($col3W, 4, '3.3  Employment (before the training)', 'B', 0, 'L');
        $y += 4;

        $rowTop = $y;
        $rowH   = 34;

        // column borders
        $pdf->Rect($lm,                      $rowTop, $col1W, $rowH);
        $pdf->Rect($lm + $col1W,             $rowTop, $col2W, $rowH);
        $pdf->Rect($lm + $col1W + $col2W,    $rowTop, $col3W, $rowH);

        // ── 3.1 Sex ───────────────────────────────────────────────────────────────
        $sex = strtolower($val('sex'));
        $checkRow($lm + 2, $rowTop + 4,  'Male',   $sex === 'male');
        $checkRow($lm + 2, $rowTop + 12, 'Female', $sex === 'female');

        // ── 3.2 Civil Status ──────────────────────────────────────────────────────
        $cs = strtolower($val('civil_status'));
        $csOpts = [
            'single'    => 'Single',
            'married'   => 'Married',
            'separated' => 'Separated/ Divorced/ Annulled',
            'widowed'   => 'Widow/er',
            'live-in'   => 'Common Law/ Live-in',
        ];
        $csY = $rowTop + 3;
        foreach ($csOpts as $key => $label) {
            $checkRow($lm + $col1W + 2, $csY, $label, str_contains($cs, $key));
            $csY += 5.8;
        }

        // ── 3.3 Employment ────────────────────────────────────────────────────────
        $emp  = strtolower($val('employment_status'));
        $empX = $lm + $col1W + $col2W + 2;
        $empY = $rowTop + 2;

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($empX, $empY);
        $pdf->Cell(45, 4, 'Employment Status', 0, 0, 'L');

        $empOpts = [
            'wage-employed' => 'Wage-Employed',
            'underemployed' => 'Underemployed',
            'self-employed' => 'Self-Employed',
            'unemployed'    => 'Unemployed',
        ];
        $empY += 5;
        foreach ($empOpts as $key => $label) {
            $checkRow($empX, $empY, $label, str_contains($emp, $key));
            $empY += 6;
        }

        $y = $rowTop + $rowH + 2;

        // ── 3.4 Birthdate ─────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(22, 5, '3.4  Birthdate', 0, 0);

        $bdate   = $val('birth_date');           // expects Y-m-d
        $bdParts = explode('-', $bdate);
        $bdData  = [
            'Month of Birth' => $bdParts[1] ?? '',
            'Day of Birth'   => $bdParts[2] ?? '',
            'Year of Birth'  => $bdParts[0] ?? '',
            'Age'            => $calcAge($bdate),
        ];
        $bW = ($cw - 22) / 4;
        $bX = $lm + 22;
        foreach ($bdData as $lbl => $bVal) {
            $pdf->Rect($bX, $y, $bW, 7);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY($bX + 1, $y + 0.5);
            $pdf->Cell($bW - 2, 6, $bVal, 0, 0, 'C');
            $bX += $bW;
        }
        // sub-labels
        $bX = $lm + 22;
        foreach (array_keys($bdData) as $lbl) {
            $pdf->SetFont('Arial', 'I', 5.5);
            $pdf->SetXY($bX, $y + 7);
            $pdf->Cell($bW, 3, $lbl, 0, 0, 'C');
            $bX += $bW;
        }
        $y += 11;

        // ── 3.5 Birthplace ────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(22, 6, '3.5  Birthplace', 0, 0);

        $bpParts = array_pad(explode(',', $val('birth_place')), 3, '');
        $bpW = ($cw - 22) / 3;
        $bpX = $lm + 22;
        foreach (['City/Municipality', 'Province', 'Region'] as $i => $lbl) {
            $pdf->Rect($bpX, $y, $bpW, 6);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY($bpX + 1, $y + 0.5);
            $pdf->Cell($bpW - 2, 5, trim($bpParts[$i] ?? ''), 0, 0, 'C');
            $pdf->SetFont('Arial', 'I', 5.5);
            $pdf->SetXY($bpX, $y + 6);
            $pdf->Cell($bpW, 3, $lbl, 0, 0, 'C');
            $bpX += $bpW;
        }
        $y += 10;

        // ── 3.6 Educational Attainment ────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '3.6  Educational Attainment Before the Training (Trainee)', 'B', 2);
        $y += 5;

        $edu     = strtolower($val('educational_attainment'));
        $eduOpts = [
            'no_grade'             => 'No Grade Completed',
            'elementary_undergrad' => 'Elementary Undergraduate',
            'elementary_grad'      => 'Elementary Graduate',
            'highschool_undergrad' => 'High School Undergraduate',
            'highschool_grad'      => 'High School Graduate',
            'junior_high'          => 'Junior High (K-12)',
            'senior_high'          => 'Senior High (K-12)',
            'postsec_undergrad'    => 'Post-Secondary Non-Tertiary/TVC Undergraduate',
            'postsec_grad'         => 'Post-Secondary Non-Tertiary/TVC Graduate',
            'college_undergrad'    => 'College Undergraduate',
            'college_grad'         => 'College Graduate',
            'masteral'             => 'Masteral',
            'doctorate'            => 'Doctorate',
        ];
        $eduCols  = array_chunk(array_keys($eduOpts), 5);
        $eduColW  = $cw / count($eduCols);
        $eduBaseY = $y;
        foreach ($eduCols as $ci => $colKeys) {
            $ex = $lm + $ci * $eduColW;
            $ey = $eduBaseY;
            foreach ($colKeys as $key) {
                $checkRow($ex, $ey, $eduOpts[$key], str_contains($edu, $key));
                $ey += 5;
            }
        }
        $y = $eduBaseY + 5 * 5 + 3;

        // ── 3.7 Parent/Guardian ───────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(32, 6, '3.7  Parent/Guardian', 0, 0);

        $guardian = $val('mother_name') ?: $val('father_name');
        $halfW    = ($cw - 32) / 2;
        $pdf->Rect($lm + 32, $y, $halfW,   6);
        $pdf->Rect($lm + 32 + $halfW, $y, $halfW, 6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + 33, $y + 0.5);
        $pdf->Cell($halfW - 2, 5, $guardian, 0, 0, 'C');

        $pdf->SetFont('Arial', 'I', 6);
        $pdf->SetXY($lm + 32, $y + 6);
        $pdf->Cell($halfW, 3, 'Name', 0, 0, 'C');
        $pdf->Cell($halfW, 3, 'Complete Permanent Mailing Address', 0, 0, 'C');

        // ══════════════════════════════════════════════════════════════════════════
        // PAGE 2
        // ══════════════════════════════════════════════════════════════════════════
        $pdf->AddPage();
        $y = 10;

        // ── Section 4 ─────────────────────────────────────────────────────────────
        $sectionHeader('4. Learner/Trainee/Student (Clients) Classification:', $y);
        $y += 6;

        $clientType = strtolower($val('client_type'));
        $clientOpts = [
            '4ps'           => '4Ps Beneficiary',
            'agrarian'      => 'Agrarian Reform Beneficiary',
            'balik'         => 'Balik Probinsya',
            'displaced'     => 'Displaced Workers',
            'drug'          => 'Drug Dependents Surrenderees/Surrenderers',
            'afp_killed'    => 'Family Members of AFP & PNP Killed-in-Action',
            'afp_wounded'   => 'Family Members of AFP & PNP Wounded-in-Action',
            'farmers'       => 'Farmers and Fishermen',
            'indigenous'    => 'Indigenous People & Cultural Communities',
            'industry'      => 'Industry Workers',
            'inmates'       => 'Inmates and Detainees',
            'milf'          => 'MILF Beneficiary',
            'oosy'          => 'Out-of-School-Youth',
            'ofw_dep'       => 'OFW Dependent',
            'rcef'          => 'RCEF-RESP',
            'rebel'         => 'Rebel Returnees/Decommissioned Combatants',
            'returning_ofw' => 'Returning/Repatriated OFW',
            'student'       => 'Student',
            'tesda_alumni'  => 'TESDA Alumni',
            'tvet'          => 'TVET Trainers',
            'uniformed'     => 'Uniformed Personnel',
            'disaster'      => 'Victim of Natural Disasters and Calamities',
            'wounded'       => 'Wounded-in-Action AFP & PNP Personnel',
            'others'        => 'Others: ___________',
        ];
        $clientCols = array_chunk(array_keys($clientOpts), (int) ceil(count($clientOpts) / 3));
        $clientColW = $cw / 3;
        foreach ($clientCols as $ci => $colKeys) {
            $cx = $lm + $ci * $clientColW;
            $cy = $y;
            foreach ($colKeys as $key) {
                $checkRow($cx, $cy, $clientOpts[$key], str_contains($clientType, $key));
                $cy += 5;
            }
        }
        $y += (int) ceil(count($clientOpts) / 3) * 5 + 4;

        // ── Section 5 ─────────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '5. Type of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel', 'B', 2);
        $y += 6;

        $disOpts = [
            'Mental/Intellectual',
            'Visual Disability',
            'Orthopedic (Musculoskeletal) Disability',
            'Hearing Disability',
            'Speech Impairment',
            'Multiple Disabilities, specify',
            'Psychosocial Disability',
            'Disability Due to Chronic Illness',
            'Learning Disability',
        ];
        foreach (array_chunk($disOpts, 3) as $row) {
            foreach ($row as $ci => $label) {
                $checkRow($lm + $ci * ($cw / 3), $y, $label, false);
            }
            $y += 5;
        }
        $y += 2;

        // ── Section 6 ─────────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '6. Causes of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel', 'B', 2);
        $y += 6;
        foreach (['Congenital/Inborn', 'Illness', 'Injury'] as $ci => $label) {
            $checkRow($lm + $ci * ($cw / 3), $y, $label, false);
        }
        $y += 8;

        // ── Section 7 ─────────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(62, 6, '7. Name of Course/Qualification', 0, 0);
        $pdf->Rect($lm + 62, $y, $cw - 62, 6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + 63, $y + 0.5);
        $pdf->Cell($cw - 64, 5, $application['training_course_name'] ?? '', 0, 0);
        $y += 8;

        // ── Section 8 ─────────────────────────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(82, 6, '8. If Scholar, What Type of Scholarship Package (TWSP, PESFA, STEP, others)?', 0, 0);
        $pdf->Rect($lm + 82, $y, $cw - 82, 6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + 83, $y + 0.5);
        $pdf->Cell($cw - 84, 5, $application['scholarship_type'] ?? '', 0, 0);
        $y += 8;

        // ── Section 9 – Privacy Consent ───────────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '9. Privacy Consent and Disclaimer', 'B', 2);
        $y += 5;

        $pdf->SetFont('Arial', 'I', 7);
        $notice = 'I hereby attest that I have read and understood the Privacy Notice of TESDA through its website '
            . '(https://www.tesda.gov.ph) and thereby giving my consent in the processing of my personal '
            . 'information indicated in this Learners Profile. The processing includes scholarships, employment, '
            . 'survey, and all other related TESDA programs that may be beneficial to my qualifications.';
        $pdf->SetXY($lm, $y);
        $pdf->MultiCell($cw, 4, $notice, 0, 'J');
        $y = $pdf->GetY() + 3;

        $agreed = $learner['agreed_to_terms'] ?? false;
        $checkRow($lm + 30,  $y, 'Agree',    (bool) $agreed,  8);
        $checkRow($lm + 80,  $y, 'Disagree', !(bool) $agreed, 8);
        $y += 8;

        // ── Section 10 – Applicant Signature ─────────────────────────────────────
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, "10. Applicant's Signature", 'B', 2);
        $y += 5;

        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, 'This is to certify that the information stated above is true and correct.', 0, 0, 'C');
        $y += 7;

        // 1x1 picture box (top right)
        $picBoxX = $lm + $cw - 33;
        $pdf->Rect($picBoxX, $y, 33, 25);
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($picBoxX, $y + 8);
        $pdf->Cell(33, 4, '1x1 picture taken', 0, 2, 'C');
        $pdf->SetX($picBoxX);
        $pdf->Cell(33, 4, 'within the last 6 months', 0, 0, 'C');

        // Signature line
        $sigW = $cw - 38;
        $sigLineY = $y + 18;
        $pdf->Line($lm, $sigLineY, $lm + $sigW, $sigLineY);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($lm, $sigLineY + 1);
        $pdf->Cell($sigW / 2, 4, "APPLICANT'S SIGNATURE OVER PRINTED NAME", 0, 0, 'C');
        $pdf->SetXY($lm + $sigW / 2, $sigLineY + 1);
        $pdf->Cell($sigW / 2, 4, 'DATE ACCOMPLISHED', 0, 0, 'C');
        $y = $sigLineY + 8;

        // Noted by
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(20, 5, 'Noted by:', 0, 0);
        $y += 14;

        // Thumbmark box (right side)
        $thumbX = $picBoxX;
        $thumbY = $y - 12;
        $pdf->Rect($thumbX, $thumbY, 33, 20);
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($thumbX, $thumbY + 8);
        $pdf->Cell(33, 4, 'Right Thumbmark', 0, 0, 'C');

        // Registrar line
        $pdf->Line($lm, $y, $lm + $sigW, $y);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($lm, $y + 1);
        $pdf->Cell($sigW / 2, 4, 'REGISTRAR/SCHOOL ADMINISTRATOR', 0, 0, 'C');
        $pdf->SetXY($lm + $sigW / 2, $y + 1);
        $pdf->Cell($sigW / 2, 4, 'DATE RECEIVED', 0, 0, 'C');
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY($lm, $y + 5);
        $pdf->Cell($sigW / 2, 4, '(Signature Over Printed Name)', 0, 0, 'C');

        return $pdf;
    }
}
