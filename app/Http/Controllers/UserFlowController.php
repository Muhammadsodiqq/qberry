<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Block;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\HistoryBooking;
use App\Http\Requests\Pagination;
use App\Services\UserFlowService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\CalculateRequest;

/**
 * @group Api's for users flow
 */
class UserFlowController extends Controller
{

    public UserFlowService $service;

    public function __construct()
    {
        $this->service = new UserFlowService();
    }
    /**
     * Get all information about location, room
     */
    public function getLocationsWithRooms(Pagination $request)
    {
        return $this->service->getLocationsWithRooms($request);
    }

    /**
     * calculate area, sum of blocks
     */
    public function Calculate(CalculateRequest $request, $location_id)
    {
        $request['location_id'] = $location_id;
        return $this->service->Calculate($request);
    }

    /**
     * Book blocks
     */
    public function BookBlocks(BookingRequest $request)
    {
        return $this->service->BookBlocks($request);
    }

    /**
     * Get My bookings
     */
    public function getMyBookings()
    {
        return $this->service->getMyBookings();
    }
}
