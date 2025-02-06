<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Ashley',
                'image' => 'logobrand.jpg',
                'description'=> 'Ashley Furniture Industries, Inc. is a U.S.-based manufacturer, distributor, and retailer of home furnishings. The company has several subsidiaries, including Ashley Global Retail that primarily focuses on marketing, distribution, sales, and e-commerce of the products and Ashley Home Store, ltd., that mainly manages all the supply and distribution of products manufactured by their parent company. Ashley Furniture Industries reported revenues of over USD 500 million in 2018.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Aaron',
                'image' => 'LOGO.png',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Row',
                'image' => 'style1.jpg',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Dunelm Group',
                'image' => 'logobrand5.png',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'French Heritage',
                'image' => 'logobrand4.png',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lazboy',
                'image' => 'logobrand3.jpg',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Harvey Norman',
                'image' => 'logobrand1.jpg',
                'description'=>'',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Steelcase',
                'image' => 'logobrand2.png',
                'description' => 'Founded in 1912, Steelcase remains to be one of the oldest and largest furniture companies in the U.S., specializing in the design, manufacture, distribution, and sales of furniture settings, interior architectural products, and the latest technology solutions. The company operates through three product segments — Systems and Storage, Seating and Others (including textiles and surface materials, tools, tech solutions), and Uncategorized Product Lines and Services. 
                
                Since 2017, Steelcase and Microsoft have been working together on Creative Spaces — an interdependent ecosystem of office workspaces — to empower individuals and teams to do their best work. They have even co-developed the Steelcase Roam, a mobile stand and wall mounting system that allows groups and individuals to work together anywhere. Steelcase recorded USD 3.4 billion in revenue in FY2019, up from USD 3.1 billion in FY2018.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jonathan Adler',
                'image' => 'logobrand7.jpeg',
                'description'=>'Jonathan Adler operates on a totally different wavelength than many of our other picks. It is louder, bolder, and more colorful. Each piece is designed by the interior designer himself, so there is a touch of whimsy and youthfulness in everything—from the catchall trays to the sofas. Nothing Adler creates is boring, so if you want to spruce up your space with some big personality, start here.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ikea',
                'image' => 'logobrand3.jpg',
                'description'=> 'IKEA is a leader among the top 10 furniture manufacturers globally and is renowned for its furnishings and home décor products. IKEA’s product portfolio includes a wide range of furnishing and home décor products such as bedding, flooring, outdoor furniture, decoration material, mirrors, lighting, kitchen cabinets and appliances, and clothes storage cabinets. The company sells its products through online stores and brick-and-mortar stores comprising of 1,002 home furnishing suppliers with its presence in 51 countries.IKEA’s retail business recorded USD 42.05 billion in revenue in FY2018, with a 4.5% increase in sales. By 2025, the company aims to expand its reach and interact with 3 billion people.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
