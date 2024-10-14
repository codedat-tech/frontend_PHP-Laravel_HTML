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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bedroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kitchen',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bathroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Office',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outdoor Space',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
