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
                'createAT' => now(),
                'description' => 'Modern living room design with minimalistic furniture.',
                'image' => 'Livingroom1 Medium.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 2,
                'designerID' => 2,
                'createAT' => now(),
                'description' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 3,
                'designerID' => 1,
                'createAT' => now(),
                'description' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 4,
                'designerID' => 3,
                'createAT' => now(),
                'description' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 5,
                'designerID' => 3,
                'createAT' => now(),
                'description' => 'Cozy bedroom with a rustic feel.',
                'image' => 'Bedroom4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 1,
                'designerID' => 1,
                'createAT' => now(),
                'description' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 3,
                'designerID' => 2,
                'createAT' => now(),
                'description' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 1,
                'designerID' => 2,
                'createAT' => now(),
                'description' => 'Sleek kitchen design with modern appliances.',
                'image' => 'kitchenIsland3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 5,
                'designerID' => 2,
                'createAT' => now(),
                'description' => 'Sleek kitchen design with....',
                'image' => 'kitchenIsland4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryDesignID' => 4,
                'designerID' => 3,
                'createAT' => now(),
                'description' => 'Sleek kitchen design with....',
                'image' => 'kitchenIsland5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
