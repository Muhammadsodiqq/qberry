<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;

/**
 * @group Api for roles
 */
class RoleController extends Controller
{
    public RoleService $service;

    public function __construct()
    {
        $this->service = new RoleService();
    }

    /**
     * Get all roles
     */
    public function get()
    {
        return $this->service->get();
    }
}
