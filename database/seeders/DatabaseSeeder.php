<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BlogSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CustomerSeeder::class,
            DesignerSeeder::class,
            OrderSeeder::class,
            ReviewOrderSeeder::class,
            ProductSeeder::class,
            OrderDetailSeeder::class,
            ConsultationSeeder::class,
            ReviewConsultationSeeder::class,
            CategoryDesignSeeder::class,
            BlueprintSeeder::class,
            BlueprintUserSeeder::class,
            ImageProductSeeder::class,
        ]);
    }
}
