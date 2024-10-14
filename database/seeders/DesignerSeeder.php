<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DesignerSeeder extends Seeder
{
    public function run()
    {
        DB::table('designers')->insert([
            [
                'fullname' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Designer Street, City, Country',
                'portfolio' => 'www.johndoeportfolio.com',
                'experienceYear' => 5,
                'specialization' => 'Interior Design',
                'rating' => 4.7,
                'image' => 'avatarDesigner1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654321',
                'address' => '456 Design Avenue, City, Country',
                'portfolio' => 'www.janesmithdesigns.com',
                'experienceYear' => 7,
                'specialization' => 'Landscape Design',
                'rating' => 4.9,
                'image' => 'avatarDesigner2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Alice Johnson',
                'email' => 'alicejohnson@example.com',
                'password' => Hash::make('password123'),
                'phone' => '1122334455',
                'address' => '789 Designer Blvd, City, Country',
                'portfolio' => 'www.alicejohnsondesign.com',
                'experienceYear' => 10,
                'specialization' => 'Architectural Design',
                'rating' => 4.8,
                'image' => 'avatarDesigner3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
