<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'name' => 'BShabby Chic',
                'title' => 'Shabby Chic Style – classic and romantic beauty',
                'description' => 'Phong Cách Shabby Chic là một phong cách thiết kế nội thất mang đậm chất vintage của nước Anh. Nó tạo ra một không gian sống ấm cúng',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Expressionism Style',
                'title' => 'Expressionism Style in Interior Design & Architecture',
                'description' => 'Trong thời kỳ xã hội đầy biến động, phong cách Expressionism đã xuất hiện thu hút sự quan tâm của đông đảo công chúng và ',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Modern Style',
                'title' => 'What is Modern Style? 6 basic characteristics!',
                'description' => 'Phong cách hiện đại là khái niệm để miêu tả những dự án dân dụng và thương mại có bố cục đơn giản, thường thiết kế theo dạng hình khối.',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minimalism',
                'title' => 'What is Minimalism? The Era of Less is More',
                'description' => 'Leonardo Davinci đã từng nói rằng: “Đơn giản chính là đỉnh cao của sự tinh tế”. Ngày nay, phong cách Minimalism đang được giới “sống tối giản” ',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
