<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\Edit;
use App\Http\Requests\User\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @group Api for users
 */
class UserController extends Controller
{
    /**
     * Create User
     */
    public function createUser(CreateUser $request)
    {
        $randStr = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randStr = substr(str_shuffle($randStr), 0, 12);

        $data = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "role_id" => $request->role_id,
            "password" => bcrypt("password"),
            "code" => $randStr,
        ]);

        return response_success([
            "ok" => true,
            "data" => $data,
        ]);
    }

    /**
     * Login User
     */
    public function login(Login $request)
    {

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response_success(
                [
                    "ok" => false,
                    'error' => 'Unauthorised.'
                ],
                401
            );
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Qberry')->accessToken;

        return response_success([
            "ok" => true,
            "data" => [
                "type" => "Bearer",
                "token" => $token
            ]
        ]);
    }

    /**
     * Update Own password
     */
    public function UpdateOwnInfo(Edit $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            "password" => bcrypt($request->password),
        ]);
        return response_success([
            "ok" => true,
            "msg" => 'User updated successfully.',
        ]);
    }
}
