<?php

namespace App\Services;

use App\Models\Role;

class UserService
{
    public function newUserRole($user)
    {
        $role = Role::where('name', 'guest')->first();
        $user->roles()->attach($role);
        $permissions = $role->permissions;
        $user->permissions()->attach($permissions);
    }
}
