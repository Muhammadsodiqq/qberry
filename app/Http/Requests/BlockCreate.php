<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockCreate extends FormRequest
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
            "price" => "required|numeric",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "length" => "required|numeric",
            "room_id" => "required|integer|exists:rooms,id",
        ];
    }
}
