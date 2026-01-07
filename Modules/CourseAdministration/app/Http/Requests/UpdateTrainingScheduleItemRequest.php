<?php

namespace Modules\CourseAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTrainingScheduleItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],

            'schedule_days' => ['required', 'array', 'min:1'],
            'schedule_days.*' => ['string'],

            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Training name is required.',
            'description.required' => 'Training description is required.',
            'schedule_days.required' => 'Please select at least one training day.',
            'schedule_days.array' => 'Training days must be a valid array.',
            'start_time.required' => 'Start time is required.',
            'end_time.after' => 'End time must be after the start time.',
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
