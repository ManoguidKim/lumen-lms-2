<?php

namespace Modules\PerformanceAdministration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateTrainingStudentBatchAttendanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'training_batch_student_id' => [
                'required',
                'integer',
                'exists:training_batch_students,id'
            ],
            'training_batch_schedule_item_id' => [
                'required',
                'integer',
                'exists:training_batch_schedule_items,id'
            ],
            'attendance_date' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'check_in_time' => [
                'nullable',
                'date_format:H:i:s'
            ],
            'check_out_time' => [
                'nullable',
                'date_format:H:i:s',
                'after:check_in_time'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'training_batch_student_id.required' => 'Training batch is required.',
            'training_batch_student_id.exists' => 'Selected training batch does not exist.',
            'training_batch_schedule_item_id.required' => 'Schedule item is required.',
            'training_batch_schedule_item_id.exists' => 'Selected schedule item does not exist.',
            'attendance_date.required' => 'Attendance date is required.',
            'attendance_date.date' => 'Invalid date format.',
            'check_in_time.date_format' => 'Check-in time must be in H:i:s format.',
            'check_out_time.date_format' => 'Check-out time must be in H:i:s format.',
            'check_out_time.after' => 'Check-out time must be after check-in time.'
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
