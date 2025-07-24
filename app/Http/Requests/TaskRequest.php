<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project_id' => ['required', 'exists:projects,id'],
            'assigned_user_id' => ['required', 'exists:users,id'],
            'is_completed' => ['sometimes', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The task title is required.',
            'project_id.required' => 'A project is required.',
            'project_id.exists' => 'The selected project is invalid.',
            'assigned_user_id.required' => 'An assigned user is required.',
            'assigned_user_id.exists' => 'The selected user is invalid.',
        ];
    }
}
