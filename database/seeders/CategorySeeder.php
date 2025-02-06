<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Living Room',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bedroom',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kitchen',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bathroom',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Office',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outdoor Space',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
