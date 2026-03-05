<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocument;
use FPDF;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

class RegisterLearnerApplicationController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        $courses = TrainingCourse::all();
        return view('application.new-application.create', compact('courses'));
    }

    public function registerExisting($uuid)
    {
        $learner = User::where('uuid', $uuid)->firstOrFail();

        $workExperiences     = $learner->work_experiences
            ? json_decode($learner->work_experiences, true)
            : [];

        $trainings           = $learner->trainings
            ? json_decode($learner->trainings, true)
            : [];

        $licensureExamination = $learner->licensure_examination
            ? json_decode($learner->licensure_examination, true)
            : [];

        $competencyAssessment = $learner->competency_assessment
            ? json_decode($learner->competency_assessment, true)
            : [];

        $courses = TrainingCourse::all();
        return view('application.re-enroll-application.index', compact(
            'course',
            'learner',
            'documents',
            'workExperiences',
            'trainings',
            'licensureExamination',
            'competencyAssessment',
        ));
    }

    public function edit($uuid)
    {
        $learner = User::where('uuid', $uuid)->firstOrFail();

        $documents          = UserDocument::where('user_id', $learner->id)->get();

        $workExperiences    = is_string($learner->work_experiences)
            ? json_decode($learner->work_experiences, true) ?? []
            : ($learner->work_experiences ?? []);

        $trainings          = is_string($learner->trainings)
            ? json_decode($learner->trainings, true) ?? []
            : ($learner->trainings ?? []);

        $licensureExamination = is_string($learner->licensure_examination)
            ? json_decode($learner->licensure_examination, true) ?? []
            : ($learner->licensure_examination ?? []);

        $competencyAssessment = is_string($learner->competency_assessment)
            ? json_decode($learner->competency_assessment, true) ?? []
            : ($learner->competency_assessment ?? []);

        return view('application.update-application.index', compact(
            'learner',
            'documents',
            'workExperiences',
            'trainings',
            'licensureExamination',
            'competencyAssessment',
        ));
    }

    public function update(Request $request, string $uuid)
    {
        $learner = User::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'uli'                                    => ['nullable', 'string', 'max:255'],
            'firstName'                              => ['required', 'string', 'max:255'],
            'middleName'                             => ['nullable', 'string', 'max:255'],
            'lastName'                               => ['required', 'string', 'max:255'],
            'suffix'                                 => ['nullable', 'string', 'max:10'],
            'sex'                                    => ['required', 'in:male,female'],
            'civilStatus'                            => ['required', 'in:single,married,widow,separated'],
            'birthDate'                              => ['required', 'date'],
            'birthPlace'                             => ['nullable', 'string', 'max:255'],
            'motherName'                             => ['nullable', 'string', 'max:255'],
            'fatherName'                             => ['nullable', 'string', 'max:255'],

            'picture'                                => ['nullable', 'image', 'max:2048'],
            'schoolName'                             => ['nullable', 'string', 'max:255'],
            'schoolAddress'                          => ['nullable', 'string'],
            'clientType'                             => ['nullable', 'in:tvet_graduating_student,tvet_graduate,industry_worker,k12,owf'],

            'addressNumberStreet'                    => ['nullable', 'string'],
            'addressBarangay'                        => ['nullable', 'string', 'max:255'],
            'addressDistrict'                        => ['nullable', 'string', 'max:255'],
            'addressCity'                            => ['nullable', 'string', 'max:255'],
            'addressProvince'                        => ['nullable', 'string', 'max:255'],
            'addressRegion'                          => ['nullable', 'string', 'max:255'],
            'addressZipCode'                         => ['nullable', 'string', 'max:10'],

            'contactMobile'                          => ['required', 'string', 'max:255'],
            'contactTel'                             => ['nullable', 'string', 'max:255'],
            'contactEmail'                           => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($learner->id)],
            'contactFax'                             => ['nullable', 'string', 'max:255'],
            'contactOthers'                          => ['nullable', 'string'],

            'educationalAttainment'                  => ['nullable', 'in:elementary_graduate,high_school_graduate,tvet_graduate,college_level,college_graduate,others'],
            'educationalAttainmentOthers'            => ['nullable', 'string', 'max:255'],
            'employmentStatus'                       => ['nullable', 'in:casual,job_order,probationary,permanent,self_employed,ofw'],

            'work_experiences'                       => ['nullable', 'array'],
            'work_experiences.*.company'             => ['nullable', 'string', 'max:255'],
            'work_experiences.*.position'            => ['nullable', 'string', 'max:255'],
            'work_experiences.*.duration'            => ['nullable', 'string', 'max:255'],
            'work_experiences.*.responsibilities'    => ['nullable', 'string'],

            'trainings'                              => ['nullable', 'array'],
            'trainings.*.title'                      => ['nullable', 'string', 'max:255'],
            'trainings.*.provider'                   => ['nullable', 'string', 'max:255'],
            'trainings.*.date'                       => ['nullable', 'string', 'max:255'],
            'trainings.*.hours'                      => ['nullable', 'string', 'max:255'],

            'licensure_examination'                  => ['nullable', 'array'],
            'licensure_examination.*.title'          => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.license_number' => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.date_taken'     => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.validity'       => ['nullable', 'string', 'max:255'],

            'competency_assessment'                      => ['nullable', 'array'],
            'competency_assessment.*.qualification'      => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.certificate_number' => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.date_issued'        => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.expiry_date'        => ['nullable', 'string', 'max:255'],

            'documents'                              => ['nullable', 'array'],
            'documents.*.id'                         => ['nullable', 'integer', 'exists:user_documents,id'],
            'documents.*.type'                       => ['nullable', 'string'],
            'documents.*.file'                       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],

            'deleted_document_ids'                   => ['nullable', 'array'],
            'deleted_document_ids.*'                 => ['integer', 'exists:user_documents,id'],
        ], [
            'contactEmail.unique'    => 'This email is already used by another learner.',
            'documents.*.file.mimes' => 'Document must be a file of type: jpg, jpeg, png, pdf.',
            'documents.*.file.max'   => 'Each document must not exceed 10MB.',
        ]);

        DB::transaction(function () use ($request, $validated, $learner) {

            if ($request->hasFile('picture')) {
                if ($learner->picture_path) {
                    Storage::disk('s3')->delete($learner->picture_path);
                }
                $picturePath = $request->file('picture')->store('profile-pictures', 's3');
            } else {
                $picturePath = $learner->picture_path;
            }

            $learner->update([
                'uli'                           => $validated['uli'] ?? null,
                'name'                          => $validated['firstName'],
                'middle_name'                   => $validated['middleName'] ?? null,
                'last_name'                     => $validated['lastName'],
                'extension'                     => $validated['suffix'] ?? null,
                'picture_path'                  => $picturePath,
                'email'                         => $validated['contactEmail'] ?? null,
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
                'work_experiences'              => !empty($validated['work_experiences'])
                    ? json_encode($validated['work_experiences'])
                    : null,
                'trainings'                     => !empty($validated['trainings'])
                    ? json_encode($validated['trainings'])
                    : null,
                'licensure_examination'         => !empty($validated['licensure_examination'])
                    ? json_encode($validated['licensure_examination'])
                    : null,
                'competency_assessment'         => !empty($validated['competency_assessment'])
                    ? json_encode($validated['competency_assessment'])
                    : null,
            ]);

            if (!empty($validated['deleted_document_ids'])) {
                $toDelete = UserDocument::whereIn('id', $validated['deleted_document_ids'])
                    ->where('user_id', $learner->id)
                    ->get();

                foreach ($toDelete as $doc) {
                    if ($doc->file && Storage::disk('s3')->exists($doc->file)) {
                        Storage::disk('s3')->delete($doc->file);
                    }
                    $doc->delete();
                }
            }

            $documentFiles  = $request->file('documents', []);
            $documentInputs = $request->input('documents', []);

            foreach ($documentInputs as $index => $docData) {
                $docId   = $docData['id'] ?? null;
                $docType = $docData['type'] ?? null;
                $docFile = $documentFiles[$index]['file'] ?? null;

                if ($docFile && $docFile->isValid()) {

                    $filePath = $docFile->store('learner-documents', 's3');

                    if ($docId) {
                        // Replace existing file
                        $existing = UserDocument::find($docId);
                        if ($existing && $existing->file) {
                            Storage::disk('s3')->delete($existing->file);
                        }
                        $existing?->update(['type' => $docType, 'file' => $filePath]);
                    } else {
                        // New document
                        UserDocument::create([
                            'user_id' => $learner->id,
                            'type'    => $docType,
                            'file'    => $filePath,
                        ]);
                    }
                } elseif ($docId) {
                    // Only update type, no new file
                    UserDocument::where('id', $docId)
                        ->where('user_id', $learner->id)
                        ->update(['type' => $docType]);
                }
            }
        });

        return redirect()
            ->route('learner-training-applications.list.registered.applicants')
            ->with('success', 'Learner application updated successfully');
    }

    /**
     * Get centers for a given course (AJAX).
     */
    public function getCenters(Request $request)
    {
        $centers = Center::query()
            ->join('training_center_courses', 'centers.id', '=', 'training_center_courses.center_id')
            ->where('training_center_courses.training_course_id', $request->course_id)
            ->where('training_center_courses.is_active', true)
            ->select('centers.id', 'centers.name')
            ->get();

        return response()->json($centers);
    }

    /**
     * Get batches for a given course + center (AJAX).
     */
    public function getBatches(Request $request)
    {
        $batches = TrainingBatch::query()
            ->where('training_course_id', $request->course_id)
            ->where('center_id', $request->center_id)
            ->whereIn('status', ['open', 'ongoing'])
            ->get(['id', 'batch_name', 'batch_code', 'start_date', 'end_date']);

        return response()->json($batches);
    }

    /**
     * Store a new learner application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'uli'                                => 'required|string|max:255|unique:users,uli',
            'firstName'                          => 'required|string|max:255',
            'middleName'                         => 'nullable|string|max:255',
            'lastName'                           => 'required|string|max:255',
            'suffix'                             => 'nullable|string|max:10',
            'picture'                            => 'nullable|image|max:2048',
            'schoolName'                         => 'nullable|string|max:255',
            'schoolAddress'                      => 'nullable|string',
            'clientType'                         => 'nullable|in:tvet_graduating_student,tvet_graduate,industry_worker,k12,owf',

            'sex'                                => 'required|in:male,female',
            'civilStatus'                        => 'required|in:single,married,widow,separated',
            'birthDate'                          => 'required|date',
            'birthPlace'                         => 'nullable|string|max:255',
            'motherName'                         => 'nullable|string|max:255',
            'fatherName'                         => 'nullable|string|max:255',

            'addressNumberStreet'                => 'nullable|string',
            'addressBarangay'                    => 'nullable|string|max:255',
            'addressDistrict'                    => 'nullable|string|max:255',
            'addressCity'                        => 'nullable|string|max:255',
            'addressProvince'                    => 'nullable|string|max:255',
            'addressRegion'                      => 'nullable|string|max:255',
            'addressZipCode'                     => 'nullable|string|max:10',

            'contactMobile'                      => 'required|string|max:255',
            'contactTel'                         => 'nullable|string|max:255',
            'contactEmail'                       => 'nullable|email|max:255|unique:users,email',
            'contactFax'                         => 'nullable|string|max:255',
            'contactOthers'                      => 'nullable|string',

            'educationalAttainment'              => 'nullable|in:elementary_graduate,high_school_graduate,tvet_graduate,college_level,college_graduate,others',
            'educationalAttainmentOthers'        => 'nullable|string|max:255',
            'employmentStatus'                   => 'nullable|in:casual,job_order,probationary,permanent,self_employed,ofw',

            'courseId'                           => 'required|exists:training_courses,id',
            'centerId'                           => 'required|exists:centers,id',
            'batchId'                            => 'nullable|exists:training_batches,id',

            'work_experiences'                   => 'nullable|array',
            'work_experiences.*.company'         => 'nullable|string|max:255',
            'work_experiences.*.position'        => 'nullable|string|max:255',
            'work_experiences.*.duration'        => 'nullable|string|max:255',
            'work_experiences.*.responsibilities' => 'nullable|string',

            'trainings'                          => 'nullable|array',
            'trainings.*.title'                  => 'nullable|string|max:255',
            'trainings.*.provider'               => 'nullable|string|max:255',
            'trainings.*.date'                   => 'nullable|string|max:255',
            'trainings.*.hours'                  => 'nullable|string|max:255',

            'licensure_examination'                  => 'nullable|array',
            'licensure_examination.*.title'          => 'nullable|string|max:255',
            'licensure_examination.*.license_number' => 'nullable|string|max:255',
            'licensure_examination.*.date_taken'     => 'nullable|string|max:255',
            'licensure_examination.*.validity'       => 'nullable|string|max:255',

            'competency_assessment'                      => 'nullable|array',
            'competency_assessment.*.qualification'      => 'nullable|string|max:255',
            'competency_assessment.*.certificate_number' => 'nullable|string|max:255',
            'competency_assessment.*.date_issued'        => 'nullable|string|max:255',
            'competency_assessment.*.expiry_date'        => 'nullable|string|max:255',

            'documents'                          => 'nullable|array',
            'documents.*.type'                   => 'nullable|string',
            'documents.*.file'                   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',

            'agreedToTerms'                      => 'accepted',
        ], [
            'uli.required'           => 'The ULI is required.',
            'uli.unique'             => 'This ULI is already registered.',
            'firstName.required'     => 'First name is required.',
            'lastName.required'      => 'Last name is required.',
            'sex.required'           => 'Sex is required.',
            'civilStatus.required'   => 'Civil status is required.',
            'birthDate.required'     => 'Date of birth is required.',
            'contactMobile.required' => 'Mobile number is required.',
            'courseId.required'      => 'Please select a training course.',
            'centerId.required'      => 'Please select a training center.',
            'agreedToTerms.accepted' => 'You must agree to the certification statement.',
            'documents.*.file.mimes' => 'Documents must be jpg, jpeg, png, or pdf.',
            'documents.*.file.max'   => 'Each document must not exceed 10MB.',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // --- Profile picture ---
            $picturePath = null;
            if ($request->hasFile('picture')) {
                $picturePath = $request->file('picture')->store('profile-pictures', 's3');
            }

            // --- Create learner ---
            $learner = User::create([
                'name'                          => $validated['firstName'],
                'middle_name'                   => $validated['middleName'] ?? null,
                'last_name'                     => $validated['lastName'],
                'extension'                     => $validated['suffix'] ?? null,
                'first_name'                    => $validated['firstName'],
                'suffix'                        => $validated['suffix'] ?? null,
                'email'                         => $validated['contactEmail'] ?? null,
                'password'                      => Hash::make('password'),
                'picture_path'                  => $picturePath,
                'uli'                           => $validated['uli'],
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
                'contact_mobile'                => $validated['contactMobile'],
                'contact_email'                 => $validated['contactEmail'] ?? null,
                'contact_fax'                   => $validated['contactFax'] ?? null,
                'contact_others'                => $validated['contactOthers'] ?? null,
                'birth_date'                    => $validated['birthDate'],
                'birth_place'                   => $validated['birthPlace'] ?? null,
                'educational_attainment'        => $validated['educationalAttainment'] ?? null,
                'educational_attainment_others' => $validated['educationalAttainmentOthers'] ?? null,
                'employment_status'             => $validated['employmentStatus'] ?? null,
                'registration_type'             => 'onsite',
                'work_experiences'              => !empty($validated['work_experiences'])
                    ? json_encode($validated['work_experiences'])
                    : null,
                'trainings'                     => !empty($validated['trainings'])
                    ? json_encode($validated['trainings'])
                    : null,
                'licensure_examination'         => !empty($validated['licensure_examination'])
                    ? json_encode($validated['licensure_examination'])
                    : null,
                'competency_assessment'         => !empty($validated['competency_assessment'])
                    ? json_encode($validated['competency_assessment'])
                    : null,
                'is_confirmed'                  => true,
                'agreed_to_terms'               => true,
            ]);

            $learner->assignRole('Student');

            // --- Documents ---
            $documentFiles  = $request->file('documents', []);
            $documentInputs = $request->input('documents', []);

            foreach ($documentInputs as $index => $docData) {
                $docType = $docData['type'] ?? null;
                $docFile = $documentFiles[$index]['file'] ?? null;

                if ($docFile && $docFile->isValid()) {
                    $filePath = $docFile->store('learner-documents', 's3');
                    UserDocument::create([
                        'user_id' => $learner->id,
                        'type'    => $docType,
                        'file'    => $filePath,
                    ]);
                }
            }

            // --- Training application ---
            $applicationData = LearnerTrainingApplication::create([
                'user_id'            => $learner->id,
                'center_id'          => $validated['centerId'],
                'training_course_id' => $validated['courseId'],
                'training_batch_id'  => $validated['batchId'] ?? null,
                'status'             => !empty($validated['batchId']) ? 'approved' : 'pending',
                'application_number' => 'APP-' . date('Y') . '-' . Str::random(16),
                'application_date'   => now()->format('Y-m-d'),
                'reviewed_by'        => auth()->user()->id,
                'reviewed_at'        => now(),
                'registration_type'  => 'onsite',
            ]);

            // --- Enroll in batch ---
            if (!empty($validated['batchId'])) {
                (new TrainingBatchStudentRepository())->create([
                    'training_batch_id' => $validated['batchId'],
                    'user_id'           => $learner->id,
                    'enrollment_date'   => now()->format('Y-m-d'),
                    'enrollment_status' => 'enrolled',
                ]);

                $this->updateBatchStatusIfFull($validated['batchId']);
            }

            // --- Generate & upload TESDA PDF ---
            // $pdf      = $this->generateTesdaForm($learner->toArray(), $applicationData->toArray());
            // $fileName = 'tesda_registration_' . $learner->id . '_' . time() . '.pdf';
            // $tmpPath  = storage_path('app/temp/' . $fileName);

            // if (!file_exists(storage_path('app/temp'))) {
            //     mkdir(storage_path('app/temp'), 0755, true);
            // }

            // $pdf->Output('F', $tmpPath);

            // $s3Path = Storage::disk('s3')->putFileAs('tesda-forms', new File($tmpPath), $fileName);
            // $learner->update(['tesda_form_path' => $s3Path]);

            // unlink($tmpPath);
        });

        return redirect()
            ->route('learner-applications-list.index')
            ->with('success', !empty($validated['batchId'])
                ? 'Learner application registered successfully'
                : 'Learner application submitted successfully and waiting for training batch assignment');
    }

    private function updateBatchStatusIfFull($batchId): void
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
            ->groupBy('training_batches.id', 'training_batches.max_participants')
            ->first();

        if ($batch && $batch->registered_students_count >= $batch->max_participants) {
            $batch->update(['status' => 'full']);
        }
    }

    private function generateTesdaForm(array $learner, array $application = []): FPDF
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetMargins(10, 10);
        $pdf->SetAutoPageBreak(false);

        $lm = 10;
        $cw = 190;

        $val = fn($key) => isset($learner[$key]) && $learner[$key] !== null
            ? (string) $learner[$key] : '';

        $sectionHeader = function (string $title, float $y) use ($pdf, $lm, $cw) {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(200, 200, 200);
            $pdf->SetXY($lm, $y);
            $pdf->Cell($cw, 5, $title, 1, 1, 'L', true);
            $pdf->SetFillColor(255, 255, 255);
        };

        $checkRow = function (float $x, float $y, string $label, bool $checked, float $fs = 6) use ($pdf) {
            $b = 3.2;
            $pdf->Rect($x, $y + 0.5, $b, $b);
            if ($checked) {
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

        // All the FPDF drawing logic is identical to the original Livewire component
        // (copied verbatim — no changes needed since it's pure PDF generation)
        $pdf->AddPage();
        $misW  = 28;
        $textW = $cw - $misW - 2;
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY($lm, 8);
        $pdf->Cell($textW, 4, 'Technical Education and Skills Development Authority', 0, 2, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetX($lm);
        $pdf->Cell($textW, 4, 'Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad ng Kasanayan', 0, 0, 'C');
        $misX = $lm + $textW + 2;
        $pdf->Rect($misX, 7, $misW, 10);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($misX, 8);
        $pdf->Cell($misW, 4, 'MIS 03-01', 0, 2, 'C');
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetX($misX);
        $pdf->Cell($misW, 4, '(ver. 2021)', 0, 0, 'C');
        $pdf->SetXY($lm, 19);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell($cw, 7, 'Registration Form', 1, 2, 'C');
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

        $y = 51;
        $sectionHeader('1. T2MIS Auto Generated', $y);
        $y += 6;
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $uliLabelW = 56;
        $uliBoxW = 78;
        $pdf->Cell($uliLabelW, 5, '1.1. Unique Learner Identifier Number:', 0, 0, 'L');
        $pdf->Rect($lm + $uliLabelW, $y, $uliBoxW, 5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + $uliLabelW + 1, $y);
        $pdf->Cell($uliBoxW - 2, 5, $val('uli'), 0, 0, 'C');
        $edLabelW = 22;
        $edBoxW = $cw - $uliLabelW - $uliBoxW - $edLabelW;
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm + $uliLabelW + $uliBoxW, $y);
        $pdf->Cell($edLabelW, 5, '1.2. Entry Date:', 0, 0, 'R');
        $edX = $lm + $uliLabelW + $uliBoxW + $edLabelW;
        $pdf->Rect($edX, $y, $edBoxW, 5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($edX + 1, $y);
        $pdf->Cell($edBoxW - 2, 5, date('Y-m-d', strtotime($application['application_date'])), 0, 0, 'C');
        $y += 7;

        $sectionHeader('2. Learner/Manpower Profile', $y);
        $y += 6;
        $nameLabelW = 22;
        $lastName   = trim($val('last_name') . ($val('suffix') ? ', ' . $val('suffix') : ''));
        $firstName  = $val('first_name');
        $middleName = $val('middle_name');
        $nameColW   = ($cw - $nameLabelW) / 3;
        $nDataH = 7;
        $nLabelH = 3.5;
        $nTotalH = $nDataH + $nLabelH;
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y + ($nDataH / 2) - 2);
        $pdf->Cell($nameLabelW, 5, '2.1  Name:', 0, 0, 'L');
        $x1 = $lm + $nameLabelW;
        $x2 = $x1 + $nameColW;
        $x3 = $x2 + $nameColW;
        $pdf->Rect($x1, $y, $nameColW, $nDataH);
        $pdf->Rect($x2, $y, $nameColW, $nDataH);
        $pdf->Rect($x3, $y, $nameColW, $nDataH);
        $pdf->SetFont('Arial', '', 8);
        foreach ([[$x1, $lastName], [$x2, $firstName], [$x3, $middleName]] as [$bx, $bv]) {
            $pdf->SetXY($bx + 1, $y + 1);
            $pdf->Cell($nameColW - 2, $nDataH - 2, $bv, 0, 0, 'C');
        }
        $subY = $y + $nDataH;
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->SetXY($x1, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'Last Name, Extension Name (Jr., Sr.)', 0, 0, 'C');
        $pdf->SetXY($x2, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'First', 0, 0, 'C');
        $pdf->SetXY($x3, $subY);
        $pdf->Cell($nameColW, $nLabelH, 'Middle', 0, 0, 'C');
        $y += $nTotalH + 3;

        $addrLabelW = 28;
        $addrW = $cw - $addrLabelW;
        $aColW = $addrW / 3;
        $aDataH = 6;
        $aSubH = 3.5;
        $aRowH = $aDataH + $aSubH;
        $addrTop = $y;
        $addrTotalH = $aRowH * 3;
        $pdf->SetFont('Arial', 'B', 8);
        foreach ([[0, '2.2  Complete'], [5, 'Permanent'], [10, 'Mailing'], [15, 'Address:']] as [$off, $txt]) {
            $pdf->SetXY($lm, $addrTop + $off);
            $pdf->Cell($addrLabelW, 5, $txt, 0, 0, 'L');
        }
        $drawAddrRow = function (float $rowY, array $fields) use ($pdf, $lm, $addrLabelW, $aColW, $aDataH, $aSubH, $val) {
            $ax = $lm + $addrLabelW;
            foreach ($fields as $field => $sublabel) {
                $pdf->Rect($ax, $rowY, $aColW, $aDataH);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY($ax + 1, $rowY + 1);
                $pdf->Cell($aColW - 2, $aDataH - 2, $val($field), 0, 0, 'L');
                $pdf->SetFont('Arial', 'I', 6);
                $pdf->SetXY($ax, $rowY + $aDataH);
                $pdf->Cell($aColW, $aSubH, $sublabel, 0, 0, 'C');
                $ax += $aColW;
            }
        };
        $drawAddrRow($addrTop,           ['address_number_street' => 'Number, Street', 'address_barangay' => 'Barangay', 'address_district' => 'District']);
        $drawAddrRow($addrTop + $aRowH,  ['address_city' => 'City/Municipality', 'address_province' => 'Province', 'address_region' => 'Region']);
        $drawAddrRow($addrTop + $aRowH * 2, ['contact_email' => 'Email Address/Facebook Account:', 'contact_mobile' => 'Contact No:', 'nationality' => 'Nationality']);
        $y = $addrTop + $addrTotalH + 4;

        $sectionHeader('3. Personal Information', $y);
        $y += 5;
        $col1W = 33;
        $col2W = 52;
        $col3W = $cw - $col1W - $col2W;
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($col1W, 4, '3.1  Sex', 'B', 0, 'L');
        $pdf->Cell($col2W, 4, '3.2.  Civil Status', 'B', 0, 'L');
        $pdf->Cell($col3W, 4, '3.3  Employment (before the training)', 'B', 0, 'L');
        $y += 4;
        $rowTop = $y;
        $rowH = 34;
        $pdf->Rect($lm, $rowTop, $col1W, $rowH);
        $pdf->Rect($lm + $col1W, $rowTop, $col2W, $rowH);
        $pdf->Rect($lm + $col1W + $col2W, $rowTop, $col3W, $rowH);
        $sex = strtolower($val('sex'));
        $checkRow($lm + 2, $rowTop + 4,  'Male',   $sex === 'male');
        $checkRow($lm + 2, $rowTop + 12, 'Female', $sex === 'female');
        $cs = strtolower($val('civil_status'));
        $csOpts = ['single' => 'Single', 'married' => 'Married', 'separated' => 'Separated/ Divorced/ Annulled', 'widowed' => 'Widow/er', 'live-in' => 'Common Law/ Live-in'];
        $csY = $rowTop + 3;
        foreach ($csOpts as $key => $label) {
            $checkRow($lm + $col1W + 2, $csY, $label, str_contains($cs, $key));
            $csY += 5.8;
        }
        $emp = strtolower($val('employment_status'));
        $empX = $lm + $col1W + $col2W + 2;
        $empY = $rowTop + 2;
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($empX, $empY);
        $pdf->Cell(45, 4, 'Employment Status', 0, 0, 'L');
        $empOpts = ['wage-employed' => 'Wage-Employed', 'underemployed' => 'Underemployed', 'self-employed' => 'Self-Employed', 'unemployed' => 'Unemployed'];
        $empY += 5;
        foreach ($empOpts as $key => $label) {
            $checkRow($empX, $empY, $label, str_contains($emp, $key));
            $empY += 6;
        }
        $y = $rowTop + $rowH + 2;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(22, 5, '3.4  Birthdate', 0, 0);
        $bdate = $val('birth_date');
        $bdParts = explode('-', $bdate);
        $bdData = ['Month of Birth' => $bdParts[1] ?? '', 'Day of Birth' => $bdParts[2] ?? '', 'Year of Birth' => $bdParts[0] ?? '', 'Age' => $calcAge($bdate)];
        $bW = ($cw - 22) / 4;
        $bX = $lm + 22;
        foreach ($bdData as $lbl => $bVal) {
            $pdf->Rect($bX, $y, $bW, 7);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY($bX + 1, $y + 0.5);
            $pdf->Cell($bW - 2, 6, $bVal, 0, 0, 'C');
            $bX += $bW;
        }
        $bX = $lm + 22;
        foreach (array_keys($bdData) as $lbl) {
            $pdf->SetFont('Arial', 'I', 5.5);
            $pdf->SetXY($bX, $y + 7);
            $pdf->Cell($bW, 3, $lbl, 0, 0, 'C');
            $bX += $bW;
        }
        $y += 11;

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

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '3.6  Educational Attainment Before the Training (Trainee)', 'B', 2);
        $y += 5;
        $edu = strtolower($val('educational_attainment'));
        $eduOpts = ['no_grade' => 'No Grade Completed', 'elementary_undergrad' => 'Elementary Undergraduate', 'elementary_grad' => 'Elementary Graduate', 'highschool_undergrad' => 'High School Undergraduate', 'highschool_grad' => 'High School Graduate', 'junior_high' => 'Junior High (K-12)', 'senior_high' => 'Senior High (K-12)', 'postsec_undergrad' => 'Post-Secondary Non-Tertiary/TVC Undergraduate', 'postsec_grad' => 'Post-Secondary Non-Tertiary/TVC Graduate', 'college_undergrad' => 'College Undergraduate', 'college_grad' => 'College Graduate', 'masteral' => 'Masteral', 'doctorate' => 'Doctorate'];
        $eduCols = array_chunk(array_keys($eduOpts), 5);
        $eduColW = $cw / count($eduCols);
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

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(32, 6, '3.7  Parent/Guardian', 0, 0);
        $guardian = $val('mother_name') ?: $val('father_name');
        $halfW = ($cw - 32) / 2;
        $pdf->Rect($lm + 32, $y, $halfW, 6);
        $pdf->Rect($lm + 32 + $halfW, $y, $halfW, 6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + 33, $y + 0.5);
        $pdf->Cell($halfW - 2, 5, $guardian, 0, 0, 'C');
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->SetXY($lm + 32, $y + 6);
        $pdf->Cell($halfW, 3, 'Name', 0, 0, 'C');
        $pdf->Cell($halfW, 3, 'Complete Permanent Mailing Address', 0, 0, 'C');

        $pdf->AddPage();
        $y = 10;
        $sectionHeader('4. Learner/Trainee/Student (Clients) Classification:', $y);
        $y += 6;
        $clientType = strtolower($val('client_type'));
        $clientOpts = ['4ps' => '4Ps Beneficiary', 'agrarian' => 'Agrarian Reform Beneficiary', 'balik' => 'Balik Probinsya', 'displaced' => 'Displaced Workers', 'drug' => 'Drug Dependents Surrenderees/Surrenderers', 'afp_killed' => 'Family Members of AFP & PNP Killed-in-Action', 'afp_wounded' => 'Family Members of AFP & PNP Wounded-in-Action', 'farmers' => 'Farmers and Fishermen', 'indigenous' => 'Indigenous People & Cultural Communities', 'industry' => 'Industry Workers', 'inmates' => 'Inmates and Detainees', 'milf' => 'MILF Beneficiary', 'oosy' => 'Out-of-School-Youth', 'ofw_dep' => 'OFW Dependent', 'rcef' => 'RCEF-RESP', 'rebel' => 'Rebel Returnees/Decommissioned Combatants', 'returning_ofw' => 'Returning/Repatriated OFW', 'student' => 'Student', 'tesda_alumni' => 'TESDA Alumni', 'tvet' => 'TVET Trainers', 'uniformed' => 'Uniformed Personnel', 'disaster' => 'Victim of Natural Disasters and Calamities', 'wounded' => 'Wounded-in-Action AFP & PNP Personnel', 'others' => 'Others: ___________'];
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

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '5. Type of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel', 'B', 2);
        $y += 6;
        $disOpts = ['Mental/Intellectual', 'Visual Disability', 'Orthopedic (Musculoskeletal) Disability', 'Hearing Disability', 'Speech Impairment', 'Multiple Disabilities, specify', 'Psychosocial Disability', 'Disability Due to Chronic Illness', 'Learning Disability'];
        foreach (array_chunk($disOpts, 3) as $row) {
            foreach ($row as $ci => $label) {
                $checkRow($lm + $ci * ($cw / 3), $y, $label, false);
            }
            $y += 5;
        }
        $y += 2;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '6. Causes of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel', 'B', 2);
        $y += 6;
        foreach (['Congenital/Inborn', 'Illness', 'Injury'] as $ci => $label) {
            $checkRow($lm + $ci * ($cw / 3), $y, $label, false);
        }
        $y += 8;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(62, 6, '7. Name of Course/Qualification', 0, 0);
        $pdf->Rect($lm + 62, $y, $cw - 62, 6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm + 63, $y + 0.5);
        $pdf->Cell($cw - 64, 5, $application['training_course_name'] ?? '', 0, 0);
        $y += 8;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(82, 6, '8. If Scholar, What Type of Scholarship Package (TWSP, PESFA, STEP, others)?', 0, 0);
        $pdf->Rect($lm + 82, $y, $cw - 82, 6);
        $y += 8;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, '9. Privacy Consent and Disclaimer', 'B', 2);
        $y += 5;
        $pdf->SetFont('Arial', 'I', 7);
        $notice = 'I hereby attest that I have read and understood the Privacy Notice of TESDA through its website (https://www.tesda.gov.ph) and thereby giving my consent in the processing of my personal information indicated in this Learners Profile. The processing includes scholarships, employment, survey, and all other related TESDA programs that may be beneficial to my qualifications.';
        $pdf->SetXY($lm, $y);
        $pdf->MultiCell($cw, 4, $notice, 0, 'J');
        $y = $pdf->GetY() + 3;
        $agreed = $learner['agreed_to_terms'] ?? false;
        $checkRow($lm + 30, $y, 'Agree',    (bool) $agreed,  8);
        $checkRow($lm + 80, $y, 'Disagree', !(bool) $agreed, 8);
        $y += 8;

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, "10. Applicant's Signature", 'B', 2);
        $y += 5;
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY($lm, $y);
        $pdf->Cell($cw, 5, 'This is to certify that the information stated above is true and correct.', 0, 0, 'C');
        $y += 7;
        $picBoxX = $lm + $cw - 33;
        $pdf->Rect($picBoxX, $y, 33, 25);
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($picBoxX, $y + 8);
        $pdf->Cell(33, 4, '1x1 picture taken', 0, 2, 'C');
        $pdf->SetX($picBoxX);
        $pdf->Cell(33, 4, 'within the last 6 months', 0, 0, 'C');
        $sigW = $cw - 38;
        $sigLineY = $y + 18;
        $pdf->Line($lm, $sigLineY, $lm + $sigW, $sigLineY);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY($lm, $sigLineY + 1);
        $pdf->Cell($sigW / 2, 4, "APPLICANT'S SIGNATURE OVER PRINTED NAME", 0, 0, 'C');
        $pdf->SetXY($lm + $sigW / 2, $sigLineY + 1);
        $pdf->Cell($sigW / 2, 4, 'DATE ACCOMPLISHED', 0, 0, 'C');
        $y = $sigLineY + 8;
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($lm, $y);
        $pdf->Cell(20, 5, 'Noted by:', 0, 0);
        $y += 14;
        $thumbX = $picBoxX;
        $thumbY = $y - 12;
        $pdf->Rect($thumbX, $thumbY, 33, 20);
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($thumbX, $thumbY + 8);
        $pdf->Cell(33, 4, 'Right Thumbmark', 0, 0, 'C');
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
