<?php

namespace App\Services;

use App\Models\Location;

/**
 * Class LocationService.
 */
class LocationService
{
    public function create($request)
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

    public function getAll()
    {
        $data = Location::get();

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
