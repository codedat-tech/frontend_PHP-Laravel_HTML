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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contemporary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minimalist',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Industrial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Scandinavian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
