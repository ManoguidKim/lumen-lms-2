<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateLearnerTrainingApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'center_id' => [
                'required',
                'integer',
                Rule::exists('centers', 'id'),
            ],
            'training_course_id' => [
                'required',
                'integer',
                Rule::exists('training_courses', 'id'),
            ],
            'reviewed_by' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'reviewed_at' => [
                'nullable',
                'date',
            ],
            'review_remarks' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'learner_remarks' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'center_id.exists' => 'The selected training center does not exist.',
            'training_course_id.exists' => 'The selected training course does not exist.',
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
