<?php

namespace App\Http\Controllers;

use App\Models\Fridge;
use Illuminate\Http\Request;
use App\Http\Requests\FridgeCreate;

/**
 * @group Api for fridges
 */
class FridgeController extends Controller
{
    /**
     * Create Fridge
     */
    public function create(FridgeCreate $request)
    {
        $data = Fridge::create([
            "name" => $request->name,
            "block_id" => $request->block_id,
        ]);

        return response()->json([
            "ok" => true,
            "data" => $data,
        ]);
    }

    /**
     * Get  fridges by block_id
     */
    public function getByBlockID($block_id)
    {
        $data = Fridge::where('block_id', $block_id)->get();

        return response()->json([
            "ok" => true,
            "data" => $data,
        ]);
    }
}
