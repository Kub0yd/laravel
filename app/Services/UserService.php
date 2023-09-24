<?php

namespace App\Services;

use App\Models\Adtech\Role;
use App\Services\DispatchService;

class UserService
{
    public function newUserRole($user)
    {
        $role = Role::where('name', 'user')->first();
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
    // public function assignRole($user, $roleName)
    // {
    //     $role = Role::where('name', 'webmaster')->first();
    //     $response = DispatchService::createResponse('test', $role);
    //     DispatchService::AdminChannelSend($response);
    //     // $user->roles()->attach($role);
    //     // $permissions = $role->permissions;
    //     // $user->permissions()->attach($permissions);
    // }
}
