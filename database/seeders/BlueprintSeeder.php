<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlueprintSeeder extends Seeder
{
    public function run()
    {
        DB::table('blueprints')->insert([
            [
                'categoryDesignID' => 1,
                'designerID' => 1,
                'name' => 'Modern living room design with minimalistic furniture.',
                'image' => 'Livingroom1 Medium.jpeg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 2,
                'designerID' => 2,
                'name' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom1.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 3,
                'designerID' => 1,
                'name' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom2.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 4,
                'designerID' => 3,
                'name' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom3.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 5,
                'designerID' => 3,
                'name' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom4.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 1,
                'designerID' => 1,
                'name' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland1.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 3,
                'designerID' => 2,
                'name' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland2.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 1,
                'designerID' => 2,
                'name' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland3.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 5,
                'designerID' => 2,
                'name' => 'Sleek kitchen design with....',
                'image' => 'kitchenIsland4.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 4,
                'designerID' => 3,
                'name' => 'Sleek kitchen design with....',
                'image' => 'kitchenIsland5.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
