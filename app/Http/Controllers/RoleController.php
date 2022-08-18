<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

/**
 * @group Api for roles
 */
class RoleController extends Controller
{
    /**
     * Get all roles
     */
    public function get()
    {
        $roles = Role::all();
        return response_success([
            'roles' => $roles,
        ]);
    }
}
