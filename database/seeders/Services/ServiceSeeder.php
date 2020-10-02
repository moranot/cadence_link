<?php

namespace Database\Seeders\Services;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database with registered API services.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'service' => 'Spotify'
        ],
        [
            'service' => 'YouTube Music'
        ]);
    }
}
