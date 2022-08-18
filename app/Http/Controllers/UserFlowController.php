<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Block;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\Pagination;
use App\Http\Requests\CalculateRequest;

class UserFlowController extends Controller
{
    public function getLocationsWithRooms(Pagination $request)
    {
        $data = Location::with([
            'rooms' =>
            function ($query) {
                 $query->withCount([
                    "blocks" => function ($query) {
                        $query->whereNull("user_id");
                    }
                ]);
            }
        ])->paginate($request->count ?? 10);

        return response()->json([
            "ok" => true,
            "data" => $data,
        ]);
    }

    public function Calculate(CalculateRequest $request,$location_id)
    {
        $amount = $request->width * $request->height * $request->length;
        $room = Room::where('location_id', $location_id)->get()->toArray();

        $arr = [];
        $sum = 0;
        foreach ($room as $key => $value) {
            if($sum >= $amount) break;
            $blocks = Block::where('room_id', $value['id'])->get()->toArray();
            foreach ($blocks as $key1 => $value1) {

                if($sum >= $amount) break;

                $sum += $value1['width'] * $value1['height'] * $value1['length'];

                $value['blocks'][] = $value1;
            }
            $arr[] = $value;
        }

        return response()->json([
            "ok" => true,
            "data" => $arr,
        ]);

    }
}
