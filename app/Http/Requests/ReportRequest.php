<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'reported_user_id' => ['required', 'exists:users,id'],
            'reason' => ['required', 'in:Fake profile,Harassment,Inappropriate photos,Spam,Scam attempt,Underage user,Other'],
            'description' => ['nullable', 'string', 'max:1500'],
        ];
    }
}
