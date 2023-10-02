<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Services\UserService;
use App\Models\User;
use App\Models\AdTech\Role;
use App\Models\AdTech\Permission;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::where('name', 'admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $adminPermission = Permission::where('name', 'administration')->first();

        DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => $adminRole->id,
        ]);
        DB::table('user_permissions')->insert([
            'user_id' => $admin->id,
            'permission_id' => $adminPermission->id,
        ]);
    }
}
