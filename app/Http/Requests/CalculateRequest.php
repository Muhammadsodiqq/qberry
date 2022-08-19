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
            "temperature" => "required|numeric|min:1",
            "to_date" => "required|integer|max:24",
        ];
    }

    public function bodyParameters()
    {
        return [
            "width" => [
                "description" => "width of the block",
            ],
            "height" => [
                "description" => "height of the block",
            ],
            "length" => [
                "description" => "length of the block",
            ],
            "temperature" => [
                "description" => "temperature of the room",
            ],
            "to_date" => [
                "description" => "date of the end of the booking",
            ],
        ];
    }
}
