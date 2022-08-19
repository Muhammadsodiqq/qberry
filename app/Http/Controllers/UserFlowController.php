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

/**
 * @group Api's for users flow
 */
class UserFlowController extends Controller
{
    /**
     * Get all information about location, room
     */
    public function getLocationsWithRooms(Pagination $request)
    {
        $data = Location::with([ 'rooms' =>
            function ( $query ) {
                $query->withCount( ["blocks" => function ($query) {
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

    /**
     * calculate area, sum of blocks
     */
    public function Calculate(CalculateRequest $request, $location_id)
    {
        $asked_area = $request->width * $request->height * $request->length;
        $room = Room::where('location_id', $location_id)->where('temperature',$request->temperature)->with("location")->get()->toArray();

        $arr = [];

        $general_area = 0;
        $general_amount = 0;
        foreach ($room as $value) {
            if ($general_area >= $asked_area) break;
            $price = 0;
            $blocks = Block::where('room_id', $value['id'])->get()->toArray();
            foreach ($blocks as $value1) {
                if ($general_area >= $asked_area) break;

                $general_area += $value1['width'] * $value1['height'] * $value1['length'];

                $value1["general_price"] = $value1['price'] * $request->to_date;
                $value['blocks'][] = $value1;
                $price += $value1['general_price'];
            }
            $value['blocks_count'] = count($value['blocks']);
            $value['general_price'] = $price;
            $general_amount += $value['general_price'];
            $arr[] = $value;
        }

        return response_success([
            "ok" => true,
            "data" => $arr,
            "general_area" => $general_area,
            "asked_area" => $asked_area,
            "general_price" => $general_amount,
        ]);
    }

    /**
     * Book blocks
     */
    public function BookBlocks(BookingRequest $request)
    {
        foreach ($request->id as $value) {


            if(Block::find($value)->user_id != null) {
                return response_error("block with id = $value is already booked",403);
            }

            Block::where("id", $value)->update([
                "user_id" => Auth::user()->id,
                "start_date_booking" => date("Y-m-d"),
                "booking_day" => $request->booking_days,
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

    /**
     * Get My bookings
     */
    public function getMyBookings()
    {
        $data = Block::where("user_id", Auth::user()->id)->with(["room" =>
            function ($query) {
                $query->with("location");
            }
        ])->get()->setAppends(["cost"]);

        $general_cost = 0;
        $general_current_cost = 0;
        $data->map(function  ($item) use (&$general_cost, &$general_current_cost) {
            $general_current_cost =  $general_current_cost += $item->cost["current_cost"];
            $general_cost =  $general_cost += $item->cost["general_cost"];
        });
        return response_success([
            "ok" => true,
            "data" => $data,
            "general_cost" => $general_cost,
            "general_current_cost" => $general_current_cost,
        ]);
    }
}
