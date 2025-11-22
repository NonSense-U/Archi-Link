<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'base' => ['required', 'array'],
            'base.name' => ['required', 'string', 'max:255'],
            'base.username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'base.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'base.phone_number' => ['string', 'max:20', 'unique:users,phone_number', 'nullable'],
            'base.password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:mentor,student']
        ];
    }
}
