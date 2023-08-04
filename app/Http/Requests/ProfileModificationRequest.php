<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileModificationRequest extends FormRequest
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
            "email" => ["required", "email", Rule::unique("users")->ignore($this->user()->id)],
            "phone_number" => ["required", "numeric", "digits_between:10,14", Rule::unique("users")->ignore($this->user()->id)],
            "departement" => "required",
        ];
    }
}
