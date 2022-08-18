<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationCreate;
use App\Http\Requests\Pagination;
use App\Models\Location;
use Illuminate\Http\Request;

/**
 * @group Api for locations
 */
class LocationController extends Controller
{
    /**
     * Create Location
     */
    public function create(LocationCreate $request)
    {
        $data = Location::create([
            "country_name" => $request->country_name,
            "city_name" => $request->city_name,
        ]);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

    /**
     * Get all locations
     */
    public function getAll()
    {
        $data = Location::get();

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

}
