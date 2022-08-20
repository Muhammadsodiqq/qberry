<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Http\Requests\Pagination;
use App\Http\Requests\RoomCreate;

/**
 * @group Api for rooms
 */
class RoomController extends Controller
{

    public RoomService $service;

    public function __construct()
    {
        $this->service = new RoomService();
    }

    /**
     * Create Room
     */
    public function create(RoomCreate $request){
        return $this->service->create($request);
    }

    /**
     * Get all rooms
     */
    public function getAll(Pagination $request){
        return $this->service->getAll($request);
    }
}
