<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryDesignSeeder extends Seeder
{
    public function run()
    {
        DB::table('category_designs')->insert([
            [
                'name' => 'Modern',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contemporary',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minimalist',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Industrial',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Scandinavian',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
