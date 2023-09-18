<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\AdTech\Role;
use App\Models\AdTech\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $webmaster = Role::where('name', 'webmaster')->first();
        $creator = Role::where('name', 'creator')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        $can_create_offers = Permission::where('name', 'can_create_offers')->first();
        $sub_offers = Permission::where('name', 'sub_offers')->first();
        $administration = Permission::where('name', 'administration')->first();
        $guest = Permission::where('name', 'guest')->first();

        DB::table('permission_role')->insert([
            'permission_id' => $can_create_offers->id,
            'role_id' => $creator->id,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => $sub_offers->id,
            'role_id' => $webmaster->id,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => $administration->id,
            'role_id' => $admin->id,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => $guest->id,
            'role_id' => $user->id,
        ]);
    }
}
