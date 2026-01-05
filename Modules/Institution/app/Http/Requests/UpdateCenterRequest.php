<?php

namespace Modules\Institution\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCenterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $centerUuid = $this->route('uuid');

        return [
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:255'],

            'code' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('centers', 'code')->ignore($centerUuid, 'uuid'),
            ],

            'type' => [
                'required',
                Rule::in([
                    'assessment_center',
                    'training_center',
                    'both',
                ]),
            ],

            'address' => ['nullable', 'string'],

            'contact_number' => ['nullable', 'string', 'max:50'],
            'contact_mobile' => ['nullable', 'string', 'max:50'],
            'contact_landline' => ['nullable', 'string', 'max:50'],

            'email' => ['nullable', 'email', 'max:255'],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],

            'logo_path' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The center name is required.',
            'name.string' => 'The center name must be a valid text.',
            'name.max' => 'The center name may not exceed 255 characters.',

            'short_name.string' => 'The short name must be a valid text.',
            'short_name.max' => 'The short name may not exceed 255 characters.',

            'code.unique' => 'The center code has already been taken.',
            'code.string' => 'The center code must be a valid text.',
            'code.max' => 'The center code may not exceed 255 characters.',

            'type.required' => 'Please select a center type.',
            'type.in' => 'The selected center type is invalid.',

            'address.string' => 'The address must be a valid text.',

            'contact_number.string' => 'The contact number must be a valid text.',
            'contact_mobile.string' => 'The mobile number must be a valid text.',
            'contact_landline.string' => 'The landline number must be a valid text.',

            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email may not exceed 255 characters.',

            'status.required' => 'Please select the center status.',
            'status.in' => 'The selected status is invalid.',

            'logo_path.string' => 'The logo path must be a valid text.',
            'logo_path.max' => 'The logo path may not exceed 255 characters.',
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
