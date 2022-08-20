<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\FridgeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFlowController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("login", [UserController::class, "login"]);

Route::group(['middleware' => ['auth:api']], function () {

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::post('create', 'createUser')->middleware(AdminMiddleware::class);
        Route::post('update-own', 'UpdateOwnInfo');
        Route::get('get/auth', 'getAuthUser');
    });

    Route::prefix('block')->controller(BlockController::class)->group(function () {
        Route::post('create', 'create')->middleware(AdminMiddleware::class);
        Route::get('get-by-room-id/{room_id}', 'getByRoomID');
    });

    Route::prefix('role')->controller(RoleController::class)->group(function () {
        Route::get('get', 'get')->middleware(AdminMiddleware::class);
    });

    Route::prefix('fridge')->controller(FridgeController::class)->group(function () {
        Route::post('create', 'create')->middleware(AdminMiddleware::class);
        Route::get('getByBlockId/{block_id}', 'getByBlockID');
    });

    Route::prefix('location')->controller(LocationController::class)->group(function () {
        Route::post('create', 'create')->middleware(AdminMiddleware::class);
        Route::get('get', 'getAll')->middleware(AdminMiddleware::class);
    });

    Route::prefix('room')->controller(RoomController::class)->group(function () {
        Route::post('create', 'create')->middleware(AdminMiddleware::class);
        Route::get('get', 'getAll')->middleware(AdminMiddleware::class);
    });

    Route::prefix('user-flow')->controller(UserFlowController::class)->group(function () {
        Route::get('get', 'getLocationsWithRooms');
        Route::post("calculate/{location_id}", "Calculate");
        Route::post("book-booking", "BookBlocks");
        Route::get("get-my-bookings", "getMyBookings");
    });

});
