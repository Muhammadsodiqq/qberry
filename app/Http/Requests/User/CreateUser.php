<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:40|unique:users",
            "role_id" => "required|exists:roles,id|integer",
       ];
    }

    public function bodyParameters()
    {
        return [
            "name" => [
                "description" => "The name of the user.",
            ],
            "email" => [
                "description" => "The email of the user.",
            ],
            "role_id" => [
                "description" => "The role id of the user.",
            ],
        ];
    }
}
