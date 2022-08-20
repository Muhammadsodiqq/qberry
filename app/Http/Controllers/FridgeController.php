<?php

namespace App\Http\Controllers;

use App\Models\Fridge;
use Illuminate\Http\Request;
use App\Services\FridgeService;
use App\Http\Requests\FridgeCreate;

/**
 * @group Api for fridges
 */
class FridgeController extends Controller
{

    public FridgeService $service;

    public function __construct()
    {
        $this->service = new FridgeService();
    }

    /**
     * Create Fridge
     */
    public function create(FridgeCreate $request)
    {
        return $this->service->create($request);
    }

    /**
     * Get  fridges by block_id
     */
    public function getByBlockID($block_id)
    {
        return $this->service->getByBlockID($block_id);
    }
}
