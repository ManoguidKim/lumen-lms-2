<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateRegisterLearnerApplicationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'courseId' => ['required'],
            'batchId' => ['nullable'],
            'centerId' => ['required'],

            // Basic Information - Required Fields
            'firstName' => ['required', 'string', 'max:255'],
            'middleName' => ['nullable', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],

            // Email and Password
            'contactEmail' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],

            // Profile Picture
            'currentPicturePath' => ['nullable', 'string', 'max:500'],

            // School Information
            'schoolName' => ['nullable', 'string', 'max:255'],
            'schoolAddress' => ['nullable', 'string', 'max:1000'],

            // Client Type
            'clientType' => [
                'nullable',
                Rule::in([
                    'tvet_graduating_student',
                    'tvet_graduate',
                    'industry_worker',
                    'k12',
                    'ofw'
                ])
            ],

            // Address Information
            'addressNumberStreet' => ['nullable', 'string', 'max:500'],
            'addressBarangay' => ['nullable', 'string', 'max:255'],
            'addressCity' => ['nullable', 'string', 'max:255'],
            'addressDistrict' => ['nullable', 'string', 'max:255'],
            'addressProvince' => ['nullable', 'string', 'max:255'],
            'addressRegion' => ['nullable', 'string', 'max:255'],
            'addressZipCode' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]{4}$/'],

            // Parent Information
            'motherName' => ['nullable', 'string', 'max:500'],
            'fatherName' => ['nullable', 'string', 'max:500'],

            // Personal Details
            'sex' => [
                'required',
                Rule::in(['male', 'female'])
            ],
            'civilStatus' => [
                'required',
                Rule::in(['single', 'married', 'widow', 'separated'])
            ],

            // Contact Information
            'contactTel' => ['nullable', 'string', 'max:50', 'regex:/^[0-9\-\+\(\)\s]+$/'],
            'contactMobile' => ['required', 'string', 'max:50', 'regex:/^(09|\+639)[0-9]{9}$/'],
            'contactFax' => ['nullable', 'string', 'max:50'],
            'contactOthers' => ['nullable', 'string', 'max:500'],

            // Birth Information
            'birthDate' => [
                'required',
                'date',
                'before:today'
            ],
            'birthPlace' => ['nullable', 'string', 'max:500'],

            // Educational Attainment
            'educationalAttainment' => [
                'nullable',
                Rule::in([
                    'elementary_graduate',
                    'high_school_graduate',
                    'tvet_graduate',
                    'college_level',
                    'college_graduate',
                    'others'
                ])
            ],
            'educationalAttainmentOthers' => [
                'nullable',
                'required_if:educationalAttainment,others',
                'string',
                'max:500',
            ],

            // Employment Status
            'employmentStatus' => [
                'nullable',
                Rule::in([
                    'casual',
                    'job_order',
                    'probationary',
                    'permanent',
                    'self_employed',
                    'ofw'
                ])
            ],

            // Registration Type
            'registrationType' => [
                'nullable',
                Rule::in(['online', 'onsite'])
            ],

            // JSON Fields - Work Experiences
            'workExperiences' => ['nullable', 'array', 'max:20'],
            // JSON Fields - Trainings
            'trainings' => ['nullable', 'array', 'max:50'],
            // JSON Fields - Licensure Examination
            'licensureExamination' => ['nullable', 'array', 'max:30'],
            // JSON Fields - Competency Assessment
            'competencyAssessment' => ['nullable', 'array', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Course and Batch indetifier
            'courseId.required' => 'The training course field is required.',
            'centerId.required' => 'The training center field is required.',

            // Basic Information
            'firstName.required' => 'The first name field is required.',
            'firstName.max' => 'The first name may not be greater than 255 characters.',
            'lastName.required' => 'The last name field is required.',
            'lastName.max' => 'The last name may not be greater than 255 characters.',

            // Email and Password
            'contactEmail.required' => 'The email address is required.',
            'contactEmail.email' => 'Please provide a valid email address.',
            'contactEmail.unique' => 'This email address is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',

            // UUID
            'uli.unique' => 'This identifier is already in use.',

            // Picture
            'currentPicturePath.max' => 'The picture path may not be greater than 500 characters.',

            // Address
            'addressZipCode.regex' => 'The ZIP code must be a valid 4-digit Philippine postal code.',

            // Contact
            'contactMobile.regex' => 'The mobile number must be a valid Philippine mobile number (e.g., 09171234567).',
            'contactTel.regex' => 'Please provide a valid telephone number.',

            // Birth Information
            'birthDate.required' => 'The birth date field is required.',
            'birthDate.before' => 'The birth date must be a date before today.',

            // Educational Attainment
            'educationalAttainmentOthers.required_if' => 'Please specify your educational attainment when selecting "others".',

            // Work Experience
            'workExperiences.max' => 'You can add a maximum of 20 work experiences.',
            // Trainings
            'trainings.max' => 'You can add a maximum of 50 trainings.',
            // Licensure Examination
            'licensureExamination.max' => 'You can add a maximum of 30 licensure examinations.',
            // Competency Assessment
            'competencyAssessment.max' => 'You can add a maximum of 50 competency assessments.',
        ];
    }
}
