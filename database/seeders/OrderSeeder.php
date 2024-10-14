<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'customerID' => 1,
                'orderDate' => '2024-09-20',
                'status' => 'Processing',
                'totalPrice' => 1500,
                'shippingAddress' => '123 Main St, City, Country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 2,
                'orderDate' => '2024-09-21',
                'status' => 'Shipped',
                'totalPrice' => 2500,
                'shippingAddress' => '456 Market Ave, City, Country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 3,
                'orderDate' => '2024-09-12',
                'status' => 'Delivered',
                'totalPrice' => 4400,
                'shippingAddress' => '321 Ocean Blvd, City, Country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 4,
                'orderDate' => '2024-09-15',
                'status' => 'Delivered',
                'totalPrice' => 5500,
                'shippingAddress' => '098 Ocean Blvd, City, Country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customerID' => 3,
                'orderDate' => '2024-09-18',
                'status' => 'Delivered',
                'totalPrice' => 555500,
                'shippingAddress' => '0123 Ocean Blvd, City, Country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
