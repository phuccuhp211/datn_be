<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('stories')->insert([
            [
                'title' => 'Câu chuyện về chó con được cứu',
                'content' => 'Một câu chuyện cảm động về một chú chó con bị bỏ rơi và được cứu.',
                'slug' => 'cau-chuyen-cho-con-duoc-cuu',
                'thumbnail' => 'https://via.placeholder.com/640x480.png/00ff11?text=Câu chuyện về chó con',
                'catalog_id' => 1, // ID danh mục câu chuyện
                'author_id' => 1, // ID tác giả
                'date' => now(),
            ],
            [
                'title' => 'Cuộc sống của một chú mèo hoang',
                'content' => 'Một cái nhìn vào cuộc sống hàng ngày của một chú mèo hoang.',
                'slug' => 'cuoc-song-cua-mot-chu-meo-hoang',
                'thumbnail' => 'https://via.placeholder.com/640x480.png/00ff22?text=Cuộc sống của một chú mèo hoang',
                'catalog_id' => 1,
                'author_id' => 1,
                'date' => now(),
            ],
        ]);
    }
}
