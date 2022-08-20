<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Block;
use App\Models\Location;
use App\Models\HistoryBooking;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserFlowService.
 */
class UserFlowService
{
    public $asked_area;
    public $to_date;
    public $general_area = 0;
    public $general_amount = 0;
    public int $price ;

    public function getLocationsWithRooms($request)
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

    public function Calculate($request)
    {
        $rooms = Room::where('location_id', $request->location_id)->where('temperature', $request->temperature)->with("location")->get()->toArray();
        $this->asked_area = $request->width * $request->height * $request->length;
        $this->to_date = $request->to_date;
        $arr = [];


        foreach ($rooms as $room) {

            if ($this->general_area >= $this->asked_area) break;
            $this->price = 0;

            $this->getFreeBlocksByLocation($room);

            $room['blocks_count'] = count($room['blocks']);

            $room['general_price'] = $this->price;

            $this->general_amount += $room['general_price'];

            $arr[] = $room;
        }

        return response_success([
            "ok" => true,
            "data" => $arr,
            "general_area" => $this->general_area,
            "asked_area" => $this->asked_area,
            "general_price" => $this->general_amount,
        ]);
    }

    public function getFreeBlocksByLocation(&$room): void
    {

        $blocks = Block::where('room_id', $room['id'])->whereNull("user_id")->get()->toArray();

        foreach ($blocks as $block) {

            if ($this->general_area >= $this->asked_area) break;

            $this->general_area += $block['width'] * $block['height'] * $block['length'];

            $block["general_price"] = $block['price'] * $this->to_date;

            $room['blocks'][] = $block;

            $this->price += $block['general_price'];
        }
    }

    public function BookBlocks($request)
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

    public function getMyBookings()
    {
        $data = Block::where("user_id", Auth::user()->id)->with( [ "room" =>
            function ($query) {
                $query->with( "location" );
            }
        ])->get()->setAppends( [ "cost" ] );

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


