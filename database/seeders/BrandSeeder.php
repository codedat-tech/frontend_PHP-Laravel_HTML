<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Ashley',
                'image' => 'logobrand.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Aaron',
                'image' => 'LOGO.png',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Row',
                'image' => 'style1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Dunelm Group',
                'image' => 'logobrand5.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'French Heritage',
                'image' => 'logobrand4.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lazboy',
                'image' => 'logobrand3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Harvey Norman',
                'image' => 'logobrand1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Steelcase',
                'image' => 'logobrand2.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RainWater',
                'image' => 'LOGO LIEN RAINWATER-01.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ikea',
                'image' => 'logobrand3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
