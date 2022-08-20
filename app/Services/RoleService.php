<?php

namespace App\Services;

use App\Models\Role;

/**
 * Class RoleService.
 */
class RoleService
{
    public function get()
    {
        $roles = Role::all();
        return response_success([
            'roles' => $roles,
        ]);
    }
}
