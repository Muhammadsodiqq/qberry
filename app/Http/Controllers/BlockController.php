<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Requests\BlockCreate;

/**
 * @group Api for blocks
 */
class BlockController extends Controller
{
    /**
     * Create Block
     */
    public function create(BlockCreate $request)
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

    /**
     * Get  blocks by room_id
     */
    public function getByRoomID($room_id)
    {
        $data = Block::where('room_id', $room_id)->get();

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
