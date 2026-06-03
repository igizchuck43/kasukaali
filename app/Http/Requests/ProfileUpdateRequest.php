<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio' => ['nullable', 'string', 'max:1000'],
            'headline' => ['nullable', 'string', 'max:120'],
            'height' => ['nullable', 'integer', 'between:120,230'],
            'education' => ['nullable', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'religion' => ['nullable', 'string', 'max:80'],
            'smoking' => ['nullable', 'string', 'max:40'],
            'drinking' => ['nullable', 'string', 'max:40'],
            'children' => ['nullable', 'string', 'max:40'],
            'zodiac' => ['nullable', 'string', 'max:40'],
            'personality_type' => ['nullable', 'string', 'max:40'],
            'love_language' => ['nullable', 'string', 'max:80'],
            'location' => ['nullable', 'string', 'max:160'],
            'max_distance' => ['nullable', 'integer', 'between:1,500'],
            'age_min' => ['required', 'integer', 'between:18,99'],
            'age_max' => ['required', 'integer', 'gte:age_min', 'between:18,99'],
            'show_me' => ['required', 'string', 'in:woman,man,everyone'],
            'profile_visibility' => ['required', 'string', 'in:public,matches_only,hidden'],
            'interests' => ['array'],
            'interests.*' => ['exists:interests,id'],
        ];
    }
}
