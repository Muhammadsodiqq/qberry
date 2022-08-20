<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationCreate;
use App\Http\Requests\Pagination;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;

/**
 * @group Api for locations
 */
class LocationController extends Controller
{

    public LocationService $service;

    public function __construct()
    {
        $this->service = new LocationService();
    }
    /**
     * Create Location
     */
    public function create(LocationCreate $request)
    {
        return $this->service->create($request);
    }

    /**
     * Get all locations
     */
    public function getAll()
    {
        return $this->service->getAll();
    }

}
