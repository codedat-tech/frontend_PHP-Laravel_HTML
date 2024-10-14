<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            [
                'fullname' => 'Tommy 1',
                'email' => 'customer1@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0912345678',
                'address' => '123 Đường ABC, TP. XYZ',
                'createdAT' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Tommy 2',
                'email' => 'customer2@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654321',
                'address' => '789 Đường DEF, TP. XYZ',
                'createdAT' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Tommy 3',
                'email' => 'customer3@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654322',
                'address' => '567 Đường DEF, TP. XYZ',
                'createdAT' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Tommy 4',
                'email' => 'customer4@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654323',
                'address' => '456 Đường DEF, TP. XYZ',
                'createdAT' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
