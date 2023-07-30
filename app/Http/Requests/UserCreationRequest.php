<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "npm" => "required|numeric|digits_between:12,18",
            "name" => "required",
            "email" => "required|email|unique:users",
            "phone_number" => "required|numeric|unique:users|digits_between:10,14",
            "departement" => "required",
            "password" => ["required", "confirmed", Password::min(8)->letters()],
            "status" => "required",
        ];
    }
}
