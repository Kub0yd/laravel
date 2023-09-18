<?php

namespace App\Services;

use App\Models\Adtech\Role;

class UserService
{
    public function newUserRole($user)
    {
        $role = Role::where('name', 'webmaster')->first();
        $user->roles()->attach($role);
        $permissions = $role->permissions;
        $user->permissions()->attach($permissions);
    }
    public function adminRole($user)
    {
        $role = Role::where('name', 'admin')->first();
        $user->roles()->attach($role);
        $permissions = $role->permissions;
        $user->permissions()->attach($permissions);
    }
}
