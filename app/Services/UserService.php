<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService.
 */
class UserService
{
    public function createUser($request)
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

    public function login($request)
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

    public function UpdateOwnInfo($request)
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

    public function getAuthUser()
    {
        $user = User::find(Auth::user()->id);
        return response_success([
            "ok" => true,
            "data" => $user,
        ]);
    }
}
