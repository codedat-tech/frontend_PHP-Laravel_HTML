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
                'scheduledAT' => '2024-10-20',
                'status' => 'Scheduled',
                'note' => 'Discuss living room design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 2,
                'customerID' => 2,
                'scheduledAT' => '2024-09-30',
                'status' => 'Pending',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 3,
                'customerID' => 3,
                'scheduledAT' => '2024-9-20',
                'status' => 'Completed',
                'note' => 'Kitchen renovation consultation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 1,
                'customerID' => 1,
                'scheduledAT' => '2024-9-2',
                'status' => 'Completed',
                'note' => 'Bedroom renovation consultation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 2,
                'customerID' => 3,
                'scheduledAT' => '2024-9-27',
                'status' => 'Scheduled',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 1,
                'customerID' => 2,
                'scheduledAT' => '2024-8-27',
                'status' => 'Cancel',
                'note' => 'Home office layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 1,
                'customerID' => 3,
                'scheduledAT' => '2024-7-27',
                'status' => 'Completed',
                'note' => 'Bathroom layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 2,
                'customerID' => 3,
                'scheduledAT' => '2024-10-27',
                'status' => 'Schedule',
                'note' => 'Bedroom layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designerID' => 3,
                'customerID' => 1,
                'scheduledAT' => '2024-12-27',
                'status' => 'Schedule',
                'note' => 'Living Room Layout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
