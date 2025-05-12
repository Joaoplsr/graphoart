<?php

namespace App\Http\Requests;

use App\Enum\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
        $rules = [
            'email' => 'email|unique:users|string|max:255|required',
            'name' => 'string|max:255|required',
            'password' => 'string|min:8|required|confirmed',
        ];

        return $rules;
    }

    protected function prepareForValidation(): void {
        $data = [];

        $data['name'] = Str::title($this->name);
        $data['email'] = Str::lower($this->email);
        $data['role_id'] = RoleEnum::REVIEWER->value;

        $this->merge($data);
    }
}
