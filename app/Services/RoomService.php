<?php

namespace App\Services;

use App\Models\Room;

/**
 * Class RoomService.
 */
class RoomService
{
    public function create($request){
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

    public function getAll($request){
        $data = Room::paginate($request->count ?? 10);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
