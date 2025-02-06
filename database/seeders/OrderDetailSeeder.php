<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_details')->insert([
            [
                'productID' => 1,
                'orderID' => 1,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'productID' => 2,
                'orderID' => 1,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'productID' => 3,
                'orderID' => 2,
                'quantity' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'productID' => 4,
                'orderID' => 2,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'productID' => 1,
                'orderID' => 3,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
        ]);
    }
}
