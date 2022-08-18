<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationCreate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "country_name" => "required|string|max:255",
            "city_name" => "required|string|max:255",
        ];
    }

    public function bodyParameters()
    {
        return [
            "country_name" => [
                "description" => "Country name",
            ],
            "city_name" => [
                "description" => "City name",
            ],
        ];
    }
}
