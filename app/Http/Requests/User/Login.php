<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|string|email|max:40",
            "password" => "required|string|min:4",
        ];
    }
}
