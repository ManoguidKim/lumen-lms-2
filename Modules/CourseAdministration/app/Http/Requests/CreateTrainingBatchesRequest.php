<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTrainingBatchesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'training_course_id' => ['required', 'integer', 'exists:training_courses,id'],
            'batch_code' => ['required', 'string', 'max:255', 'unique:training_batches,batch_code'],
            'batch_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'max_participants' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', Rule::in(['open', 'full', 'ongoing', 'completed', 'cancelled'])],
            'training_schedule_item_id' => ['integer', 'exists:training_schedule_items,id'],
            'trainer_id' => ['integer', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
            'center_id' => ['integer', 'exists:centers,id'],
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
            'start_date.after_or_equal' => 'The start date must be today or a future date.',
            'end_date.after' => 'The end date must be after the start date.',
            'max_participants.min' => 'Maximum participants must be at least 0.',
            'status.in' => 'Invalid status selected.',
            'trainer_id.exists' => 'The selected trainer does not exist.',
            'training_schedule_item_id.exists' => 'The selected schedule does not exist.',
            'center_id.exists' => 'The selected center does not exist.',
        ];
    }
}
