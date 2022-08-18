<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "width" => "required|numeric|min:1",
            "height" => "required|numeric|min:1",
            "length" => "required|numeric|min:2",
        ];
    }
}
