<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pagination extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "count" => "integer",
            "page" => "integer",
        ];
    }

    public function bodyParameters()
    {
        return [
            "count" => [
                "description" => "Count of items per page . Default is 10",
            ],
            "page" => [
                "description" => "Page number . Default is 1",
            ],
        ];
    }
}
