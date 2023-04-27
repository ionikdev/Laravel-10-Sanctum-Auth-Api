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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'max:255', 'unique:users'],
            'gender'=>[ 'string', 'max:16',],
            'phone_number'=>[ 'string', 'max:16',],
            'country'=>[ 'string', 'max:16',],
            'password'=>[ 'string', 'max:16',]
        ];
    }
}
