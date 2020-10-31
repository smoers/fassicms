<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    public function add(){

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit worksheet']);
        dd($permission);
        return "permissions";

    }
}
