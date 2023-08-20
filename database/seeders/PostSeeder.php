<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;
use Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->truncate();

        DB::table('posts')->insert([
            'title' => Str::random(),
            'subtitle' => Str::random(),
            'content' => Str::random(),
            'date_publication'=> Carbon\Carbon::now()
        ]);
    }
}
