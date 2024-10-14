<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlueprintUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('blueprint_users')->insert([
            [
                'customerID' => 1,
                'blueprintID' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 2,
                'blueprintID' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 3,
                'blueprintID' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
