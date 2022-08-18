<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Room;
use App\Models\Block;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\Pagination;
use App\Http\Requests\CalculateRequest;
use App\Models\HistoryBooking;
use Illuminate\Support\Facades\Auth;

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

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

    public function Calculate(CalculateRequest $request, $location_id)
    {
        $amount = $request->width * $request->height * $request->length;
        $room = Room::where('location_id', $location_id)->with("location")->get()->toArray();

        $arr = [];
        $sum = 0;
        $price = 0;
        foreach ($room as $value) {
            if ($sum >= $amount) break;
            $blocks = Block::where('room_id', $value['id'])->get()->toArray();
            foreach ($blocks as $value1) {

                if ($sum >= $amount) break;

                $sum += $value1['width'] * $value1['height'] * $value1['length'];

                $value['blocks'][] = $value1;
                $price += $value1['price'];
            }
            if (!$value['blocks']) break;
            $value['blocks_count'] = count($value['blocks']);
            $value['general_price'] = $price;
            $arr[] = $value;
        }

        return response_success([
            "ok" => true,
            "data" => $arr,
            "general_area" => $sum,
            "asked_area" => $amount,
        ]);
    }

    public function Booking(BookingRequest $request)
    {
        foreach ($request->id as $value) {


            if(Block::find($value)->user_id != null) {

                return response_error("block with id = $value is already booked",403);

            }

            Block::where("id", $value)->update([
                "user_id" => Auth::user()->id,
                "start_date_booking" => date("Y-m-d"),
            ]);

            HistoryBooking::create([
                "block_id" => $value,
                "user_id" => Auth::user()->id,
                "start_date_booking" => date("Y-m-d"),
            ]);
        }

        return response_success([
            "ok" => true,
            "msg" => "Booking success",
        ]);
    }

    // public function getOwnBookings()
    // {
    //     $data = Block::where("user_id", Auth::user()->id)->with(["room" =>
    //         function ($query) {
    //             $query->with("location");
    //         }
    //     ])->get();

    //     return response_success([
    //         "ok" => true,
    //         "data" => $data,
    //     ]);
    // }
}
