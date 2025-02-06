<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        DB::table('consultations')->insert([
            [
                'designerID' => 1,
                'customerID' => 1,
                'scheduledAT' => '2024-11-16',
                'status1' => 'Shipping',
                'note' => 'Discuss living room design',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 2,
                'customerID' => 2,
                'scheduledAT' => '2024-11-17',
                'status1' => 'Schedule',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 3,
                'customerID' => 3,
                'scheduledAT' => '2024-11-16',
                'status1' => 'Scheduled',
                'note' => 'Kitchen renovation consultation',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 1,
                'customerID' => 1,
                'scheduledAT' => '2024-11-20',
                'status1' => 'Completed',
                'note' => 'Bedroom renovation consultation',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 2,
                'customerID' => 3,
                'scheduledAT' => '2024-11-19',
                'status1' => 'Scheduled',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 1,
                'customerID' => 2,
                'scheduledAT' => '2024-11-04',
                'status1' => 'Cancel',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 1,
                'customerID' => 3,
                'scheduledAT' => '2024-11-27',
                'status1' => 'Completed',
                'note' => 'Bathroom layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 2,
                'customerID' => 3,
                'scheduledAT' => '2024-11-27',
                'status1' => 'Schedule',
                'note' => 'Bedroom layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
            [
                'designerID' => 3,
                'customerID' => 1,
                'scheduledAT' => '2024-12-27',
                'status1' => 'Schedule',
                'note' => 'Living Room Layout',
                'created_at' => now(),
                'updated_at' => now(),
                'status' => '1',
            ],
        ]);
    }
}
