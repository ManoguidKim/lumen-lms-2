<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\CourseAdministration\Models\TrainingBatch;

class UpdateTrainingBatchesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $batchUuid = $this->route('uuid');

        return [
            'training_course_id' => ['required', 'integer', 'exists:training_courses,id'],
            'batch_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('training_batches', 'batch_code')->ignore($batchUuid, 'uuid')
            ],
            'batch_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'max_participants' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', Rule::in(['open', 'full', 'ongoing', 'completed', 'cancelled'])],
            'trainer_id' => ['nullable', 'integer', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
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
            'training_course_id.required' => 'Please select a training course.',
            'training_course_id.exists' => 'The selected training course does not exist.',
            'batch_code.required' => 'The batch code is required.',
            'batch_code.unique' => 'This batch code is already in use.',
            'end_date.after' => 'The end date must be after the start date.',
            'max_participants.min' => 'Maximum participants must be at least 0.',
            'status.in' => 'Invalid status selected.',
            'trainer_id.exists' => 'The selected trainer does not exist.',
        ];
    }
}
