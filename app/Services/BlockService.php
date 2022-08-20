<?php

namespace App\Services;

use App\Models\Block;

/**
 * Class BlockService.
 */
class BlockService
{
    public function create($request)
    {
        $data = Block::create([
            "name" => $request->name,
            "price" => $request->price,
            "width" => $request->width,
            "height" => $request->height,
            "length" => $request->length,
            "room_id" => $request->room_id,
        ]);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

    public function getByRoomID($room_id)
    {
        $data = Block::where('room_id', $room_id)->get();

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
