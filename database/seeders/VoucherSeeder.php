<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'code' => 'NEWYEAR2025',
                'discount' => 10.00, // 10% discount
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'HAPPYBIRTHDAY',
                'discount' => 15.50, // 15.5% discount
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'FLAT50',
                'discount' => 20.75, // 20.75% discount
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
