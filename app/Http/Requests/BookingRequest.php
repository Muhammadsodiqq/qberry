<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "id" => "required|array",
            "id.*" => "required|integer|exists:blocks,id",
            "booking_days" => "required|integer|max:24",
        ];
    }

    public function bodyParameters()
    {
        return [
            "id" =>[
                "description" => "Array of block ids",
            ],
            "booking_days" => [
                "description" => "Number of days of the booking",
            ],
        ];
    }
}
