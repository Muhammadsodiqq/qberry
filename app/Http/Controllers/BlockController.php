<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Requests\BlockCreate;
use App\Services\BlockService;

/**
 * @group Api for blocks
 */
class BlockController extends Controller
{
    public BlockService $service;
    public function __construct()
    {
        $this->service = new BlockService();
    }

    /**
     * Create Block
     */
    public function create(BlockCreate $request)
    {
        return $this->service->create($request);
    }

    /**
     * Get  blocks by room_id
     */
    public function getByRoomID($room_id)
    {
        return $this->service->getByRoomID($room_id);
    }
}
