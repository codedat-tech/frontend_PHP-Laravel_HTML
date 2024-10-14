<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                //living room
                'categoryID' => 1,      //6
                'brandID' => 1,         //10
                'name' => 'Sofa1',
                'price' => 499.99,
                'quantity' => 20,
                'description' => 'A stylish modern sofa.',
                'image' => 'Sofa1_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 1,      //6
                'brandID' => 2,         //10
                'name' => 'Sofa Modern 3',
                'price' => 99.99,
                'quantity' => 200,
                'description' => 'A stylish modern sofa.',
                'image' => 'Sofa1_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 1,      //6
                'brandID' => 2,         //10
                'name' => 'Sofa Modern 2',
                'price' => 499.99,
                'quantity' => 12,
                'description' => 'A stylish modern sofa 2.',
                'image' => 'Sofa1_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 1,      //6
                'brandID' => 4,         //10
                'name' => 'Sofa Modern 3',
                'price' => 299.99,
                'quantity' => 11,
                'description' => 'A stylish modern sofa 3.',
                'image' => 'Sofa1_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 1,      //6
                'brandID' => 5,         //10
                'name' => 'Sofa Modern 4',
                'price' => 999.99,
                'quantity' => 3,
                'description' => 'A stylish modern sofa 4.',
                'image' => 'Sofa1_5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 1,      //6
                'brandID' => 6,         //10
                'name' => 'Sofa Modern 5',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'A stylish modern sofa 5.',
                'image' => 'Sofa2_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // bebroom
            [
                'categoryID' => 2,      //6
                'brandID' => 9,         //10
                'name' => 'Bed Room 1',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'bed room.',
                'image' => 'bed1_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 2,      //6
                'brandID' => 10,         //10
                'name' => 'Bed Room 1',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'bed room.',
                'image' => 'bed1_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 2,      //6
                'brandID' => 6,         //10
                'name' => 'Bed Room 1',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'bed room.',
                'image' => 'bed1_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 2,      //6
                'brandID' => 7,         //10
                'name' => 'Bed Room 1',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'bed room.',
                'image' => 'bed1_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 2,      //6
                'brandID' => 8,         //10
                'name' => 'Bed Room 1',
                'price' => 899.99,
                'quantity' => 6,
                'description' => 'bed room.',
                'image' => 'bed2_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // dinner
            [
                'categoryID' => 3,
                'brandID' => 1,
                'name' => 'Wooden Dining Table',
                'price' => 2199.99,
                'quantity' => 5,
                'description' => 'Elegant wooden dining table for 6.',
                'image' => 'dining_table1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 3,
                'brandID' => 2,
                'name' => 'Wooden Dining Table',
                'price' => 29.99,
                'quantity' => 135,
                'description' => 'Elegant wooden dining table for 63.',
                'image' => 'dining_table2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 3,
                'brandID' => 5,
                'name' => 'Wooden Dining Table 2',
                'price' => 269.49,
                'quantity' => 51,
                'description' => 'Elegant wooden dining table for 32.',
                'image' => 'dining_table3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 3,
                'brandID' => 6,
                'name' => 'Wooden Dining Table 6',
                'price' => 245.99,
                'quantity' => 150,
                'description' => 'Elegant wooden dining table for 245.',
                'image' => 'dining_table4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 3,
                'brandID' => 8,
                'name' => 'Wooden Dining Table 34',
                'price' => 39.99,
                'quantity' => 35,
                'description' => 'Elegant wooden dining table for 634.',
                'image' => 'dining_table5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //bathroom
            [
                'categoryID' => 4,
                'brandID' => 1,
                'name' => 'Bathroom',
                'price' => 49.99,
                'quantity' => 10,
                'description' => 'for your collection.',
                'image' => 'bathroom1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 4,
                'brandID' => 2,
                'name' => 'Bathroom 2',
                'price' => 4.99,
                'quantity' => 120,
                'description' => 'for your collection.',
                'image' => 'bathroom2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 4,
                'brandID' => 3,
                'name' => 'Bathroom',
                'price' => 6.99,
                'quantity' => 106,
                'description' => 'for your collection.',
                'image' => 'bathroom3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 4,
                'brandID' => 4,
                'name' => 'Bathroom',
                'price' => 9.99,
                'quantity' => 10,
                'description' => 'for your collection.',
                'image' => 'bathroom4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 4,
                'brandID' => 5,
                'name' => 'Bathroom',
                'price' => 49.9,
                'quantity' => 10,
                'description' => 'for your collection.',
                'image' => 'bathroom5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // chair
            [
                'categoryID' => 5,
                'brandID' => 1,
                'name' => 'Office Chair',
                'price' => 199.99,
                'quantity' => 30,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair1_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 2,
                'name' => 'Office Chair 2',
                'price' => 199.00,
                'quantity' => 301,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair1_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 3,
                'name' => 'Office Chair 43',
                'price' => 139.01,
                'quantity' => 770,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair1_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 4,
                'name' => 'Office Chair 444',
                'price' => 444.99,
                'quantity' => 444,
                'description' => 'Comfortable accent chair for any room 444.',
                'image' => 'chair1_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 5,
                'name' => 'Office Chair 2',
                'price' => 91.99,
                'quantity' => 3,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair1_5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 6,
                'name' => 'Office Chair 2',
                'price' => 901.99,
                'quantity' => 5,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair2_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 7,
                'name' => 'Office Chair 2',
                'price' => 1.99,
                'quantity' => 5,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair2_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 8,
                'name' => 'Office Chair 2',
                'price' => 9.99,
                'quantity' => 51,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair2_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 9,
                'name' => 'Office Chair 2',
                'price' => 9.99,
                'quantity' => 5,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair2_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryID' => 5,
                'brandID' => 10,
                'name' => 'Office Chair 2',
                'price' => 11.99,
                'quantity' => 15,
                'description' => 'Comfortable accent chair for any room.',
                'image' => 'chair3_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
