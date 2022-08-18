<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FridgeCreate extends FormRequest
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
            "block_id" => "required|integer|exists:blocks,id",
        ];
    }

    public function bodyParameters()
    {
        return [
            "name" => [
                "description" => "Name of the fridge",
            ],
            "block_id" => [
                "description" => "Block id of the fridge",
            ],
        ];
    }
}
