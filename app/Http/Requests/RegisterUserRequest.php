<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email',
            'password' => 'required|string:min:8',
            'role' => 'required|in:student,lecturer'
        ];
    }

    public function messages()
    {
        return [
            'role.in' => 'role only accepted in :values'
        ];
    }
}
