<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([
            'name' => 'can_create_offers',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sub_offers',
        ]);
        DB::table('permissions')->insert([
            'name' => 'administration',
        ]);
        DB::table('permissions')->insert([
            'name' => 'guest',
        ]);
    }
}
