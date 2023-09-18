<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdTech\Role;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.ru',
            'password' => Hash::make('12341234'),
        ]);

        // $adminUser = User::where('name', 'admin')->first();
        // $role = Role::where('name', 'admin')->first();
        // $adminUser->roles()->attach($role);
        // $permissions = $role->permissions;
        // $adminUser->permissions()->attach($permissions);

    }
}
