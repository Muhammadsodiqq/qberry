<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

    });

    Route::prefix('role')->controller(RoleController::class)->middleware(AdminMiddleware::class)->group(function () {

        Route::get('get', 'get');

    });

});

