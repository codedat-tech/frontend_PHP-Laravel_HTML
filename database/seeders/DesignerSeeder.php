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
                'password' => Hash::make('designer123'),
                'phone' => '1234567890',
                'address' => '123 Designer Street, City, Country',
                'portfolio' => 'jame doe.pdf',
                'experienceYear' => 5,
                'specialization' => 'Interior Design',
                'rating' => 4.7,
                'image' => 'avatarDesigner1.jpg',
                'created_at' => '2023-09-01',
                'updated_at' => '2023-09-01',
                'status' => '1',
            ],
            [
                'fullname' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('designer123'),
                'phone' => '0987654321',
                'address' => '456 Design Avenue, City, Country',
                'portfolio' => 'jame smith.pdf',
                'experienceYear' => 7,
                'specialization' => 'Landscape Design',
                'rating' => 4.9,
                'image' => 'avatarDesigner2.jpg',
                'created_at' => '2024-08-01',
                'updated_at' => '2024-08-01',
                'status' => '1',
            ],
            [
                'fullname' => 'Alice Johnson',
                'email' => 'alicejohnson@example.com',
                'password' => Hash::make('designer123'),
                'phone' => '1122334455',
                'address' => '789 Designer Blvd, City, Country',
                'portfolio' => 'Alice Johnson.pdf',
                'experienceYear' => 10,
                'specialization' => 'Architectural Design',
                'rating' => 4.8,
                'image' => 'avatarDesigner3.jpg',
                'created_at' => '2024-09-01',
                'updated_at' => '2024-09-01',
                'status' => '1',
            ],
            [
                'fullname' => 'Nguyen Quoc Khanh',
                'email' => 'nguyenquockhanh@example.com',
                'password' => Hash::make('designer123'),
                'phone' => '1122334466',
                'address' => '789 Designer Blvd, City, sysney',
                'portfolio' => 'nqk.pdf',
                'experienceYear' => 20,
                'specialization' => 'Architectural Design',
                'rating' => 4.8,
                'image' => 'NQK.jpg',
                'created_at' => '2024-09-01',
                'updated_at' => '2024-09-01',
                'status' => '1',
            ],
            [
                'fullname' => 'Nguyen Hoang Nguyen',
                'email' => 'nguyenhoangnguyen@example.com',
                'password' => Hash::make('designer123'),
                'phone' => '1122337766',
                'address' => '789 Designer Blvd, City, vietnam',
                'portfolio' => 'nhn.pdf',
                'experienceYear' => 20,
                'specialization' => 'Architectural Design',
                'rating' => 4.8,
                'image' => 'NHN.jpg',
                'created_at' => '2024-09-01',
                'updated_at' => '2024-09-01',
                'status' => '1',
            ],
            [
                'fullname' => 'Van Thi Nho',
                'email' => 'vanthinho@example.com',
                'password' => Hash::make('designer123'),
                'phone' => '1122334488',
                'address' => '789 Designer Blvd, City, dong nai',
                'portfolio' => 'vtn.pdf',
                'experienceYear' => 20,
                'specialization' => 'Architectural Design',
                'rating' => 4.8,
                'image' => 'VTN.jpg',
                'created_at' => '2024-09-01',
                'updated_at' => '2024-09-01',
                'status' => '1',
            ]
        ]);
    }
}
