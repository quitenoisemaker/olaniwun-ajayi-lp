<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        $projectId = $this->route('project') ? $this->route('project')->id : null;

        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('projects')->ignore($projectId)],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The project title is required.',
            'title.unique' => 'This project title is already in use.',
        ];
    }
}
