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
                'orderDate' => '2023-08-20',
                'status1' => 'Processing',
                'totalPrice' => 1500,
                'shippingAddress' => '123 Main St, City, Country',
                'created_at' => '2023-08-01',
                'updated_at' => '2023-08-01',
                'status' => '1',
            ],
            [
                'customerID' => 2,
                'orderDate' => '2024-08-21',
                'status1' => 'Shipping',
                'totalPrice' => 2500,
                'shippingAddress' => '456 Market Ave, City, Country',
                'created_at' => '2024-08-01',
                'updated_at' => '2024-08-01',
                'status' => '1',
            ],
            [
                'customerID' => 3,
                'orderDate' => '2024-09-12',
                'status1' => 'Deliveried',
                'totalPrice' => 4400,
                'shippingAddress' => '321 Ocean Blvd, City, Country',
                'created_at' => '2024-08-01',
                'updated_at' => '2024-08-01',
                'status' => '1',
            ],
            [
                'customerID' => 4,
                'orderDate' => '2024-09-15',
                'status1' => 'Deliveried',
                'totalPrice' => 5500,
                'shippingAddress' => '098 Ocean Blvd, City, Country',
                'created_at' => '2024-07-01',
                'updated_at' => '2024-07-01',
                'status' => '1',
            ],
            [
                'customerID' => 3,
                'orderDate' => '2024-10-18',
                'status1' => 'Deliveried',
                'totalPrice' => 555500,
                'shippingAddress' => '0123 Ocean Blvd, City, Country',
                'created_at' => '2024-09-01',
                'updated_at' => '2024-09-01',
                'status' => '1',
            ],
        ]);
    }
}
