<?php

namespace App\Services;

use App\Models\Fridge;

/**
 * Class FridgeService.
 */
class FridgeService
{
    public function create($request)
    {
        $data = Fridge::create([
            "name" => $request->name,
            "block_id" => $request->block_id,
        ]);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }


    public function getByBlockID($block_id)
    {
        $data = Fridge::where('block_id', $block_id)->get();

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
