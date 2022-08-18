<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pagination;
use App\Http\Requests\RoomCreate;
use App\Models\Room;
use Illuminate\Http\Request;

/**
 * @group Api for rooms
 */
class RoomController extends Controller
{
    /**
     * Create Room
     */
    public function create(RoomCreate $request){
        $data = Room::create([
            "temperature" => $request->temperature,
            "location_id" => $request->location_id,
            "name" => $request->name,
        ]);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

    /**
     * Get all rooms
     */
    public function getAll(Pagination $request){
        $data = Room::paginate($request->count ?? 10);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
