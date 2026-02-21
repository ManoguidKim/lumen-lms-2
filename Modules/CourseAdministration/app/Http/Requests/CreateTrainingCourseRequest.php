<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateTrainingCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'course_code' => [
                'required',
                'string',
                'max:255',
                'unique:training_courses,course_code',
            ],
            'course_name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'duration_hours' => [
                'required',
                'integer',
                'min:1',
                'max:10000',
            ],
            'status' => [
                'required',
                'in:Active,Inactive'
            ],
            'is_tesda_course' => [
                'required',
                'boolean',
            ],
            'tr_number' => [
                'nullable',
                'required_if:is_tesda_course,1',
                'string',
                'max:255',
                'unique:training_courses,tr_number',
            ],
            'course_center_id'   => 'required|array',
            'course_center_id.*' => 'exists:centers,id',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            // Course code
            'course_code.required' => 'Course code is required.',
            'course_code.string' => 'Course code must be a valid string.',
            'course_code.max' => 'Course code may not exceed 255 characters.',
            'course_code.unique' => 'This course code already exists.',

            // Course name
            'course_name.required' => 'Course name is required.',
            'course_name.string' => 'Course name must be a valid string.',
            'course_name.max' => 'Course name may not exceed 255 characters.',

            // Description
            'description.string' => 'Description must be a valid text.',
            'description.max' => 'Description may not exceed 5,000 characters.',

            // Duration
            'duration_hours.required' => 'Duration (in hours) is required.',
            'duration_hours.integer' => 'Duration must be a whole number.',
            'duration_hours.min' => 'Duration must be at least 1 hour.',
            'duration_hours.max' => 'Duration cannot exceed 10,000 hours.',

            // Status
            'status.required' => 'Course status is required.',
            'status.in' => 'Status must be either Active or Inactive.',

            // TESDA
            'is_tesda_course.required' => 'Please specify if this is a TESDA course.',
            'is_tesda_course.boolean' => 'TESDA course value must be true or false.',

            // TR number
            'tr_number.required_if' => 'TR number is required when the course is marked as a TESDA course.',
            'tr_number.string' => 'TR number must be a valid string.',
            'tr_number.max' => 'TR number may not exceed 255 characters.',
            'tr_number.unique' => 'This TR number is already assigned to another course.',

            // Course centers
            'course_center_id.required' => 'Please select at least one center for this course.',
            'course_center_id.array' => 'Invalid format for course centers.',
            'course_center_id.*.exists' => 'One or more selected centers do not exist.',
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }
}
