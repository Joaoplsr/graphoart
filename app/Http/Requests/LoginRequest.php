<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LoginRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email|string|max:255',
            'password' => 'required|min:8|string'
        ];

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        $data['email'] = Str::lower($this->email);

        $this->merge($data);
    }
}
