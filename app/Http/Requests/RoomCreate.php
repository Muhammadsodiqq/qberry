<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomCreate extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "temperature" => "required|numeric|in:4,3,2,1,0",
            "location_id" => "required|integer|exists:locations,id",
            "name" => "required|string|max:255",
        ];
    }

    public function bodyParameters()
    {
        return [
            "temperature" => [
                "description" => "Temperature of the room",
            ],
            "location_id" => [
                "description" => "Location id of the room",
            ],
            "name" => [
                "description" => "Name of the room",
            ],
        ];
    }
}

