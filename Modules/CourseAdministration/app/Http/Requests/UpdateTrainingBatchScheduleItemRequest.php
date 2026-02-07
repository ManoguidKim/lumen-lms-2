<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTrainingBatchScheduleItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'training_batch_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:training_batches,id'
            ],
            'training_schedule_item_id' => [
                'nullable',
                'integer',
                'exists:training_schedule_items,id'
            ],
            'session_title' => [
                'nullable',
                'string',
                'max:255',
                'min:3'
            ],
            'description' => [
                'nullable',
                'string',
                'max:5000'
            ],
            'session_type' => [
                'nullable',
                'string',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:10000'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'training_batch_id.required' => 'Please select a training batch.',
            'training_batch_id.exists' => 'The selected training batch does not exist.',
            'training_schedule_item_id.exists' => 'The selected training schedule item does not exist.',
            'session_title.required' => 'Session title is required.',
            'session_title.min' => 'Session title must be at least :min characters.',
            'session_title.max' => 'Session title cannot exceed :max characters.',
            'session_type.required' => 'Please select a session type.',
            'session_type.in' => 'The selected session type is invalid.',
            'description.max' => 'Description cannot exceed :max characters.',
            'notes.max' => 'Notes cannot exceed :max characters.',
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
