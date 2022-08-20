<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\User\Edit;
use App\Http\Requests\User\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\CreateUser;

/**
 * @group Api for users
 */
class UserController extends Controller
{

    public UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Create User
     */
    public function createUser(CreateUser $request)
    {
        return $this->service->createUser($request);
    }

    /**
     * Login User
     */
    public function login(Login $request)
    {
        return $this->service->login($request);
    }

    /**
     * Update Own password
     */
    public function UpdateOwnInfo(Edit $request)
    {
        return $this->service->UpdateOwnInfo($request);
    }

    /**
     * get Auth user
     */

    public function getAuthUser()
    {
        return $this->service->getAuthUser();
    }
}
