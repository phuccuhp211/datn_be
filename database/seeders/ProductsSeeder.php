<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Thức ăn cho chó',
                'img' => 'https://via.placeholder.com/640x480.png/00aa11?text=Thức ăn cho chó',
                'purpose' => 'Cung cấp dinh dưỡng cho chó',
                'slug' => 'thuc-an-cho-cho',
                'type' => 1, // ID danh mục
            ],
            [
                'name' => 'Thức ăn cho mèo',
                'img' => 'https://via.placeholder.com/640x480.png/00bb22?text=Thức ăn cho mèo',
                'purpose' => 'Cung cấp dinh dưỡng cho mèo',
                'slug' => 'thuc-an-cho-meo',
                'type' => 1,
            ],
            [
                'name' => 'Bát ăn cho thú cưng',
                'img' => 'https://via.placeholder.com/640x480.png/00cc33?text=Bát ăn cho thú cưng',
                'purpose' => 'Bát ăn bằng inox cho thú cưng',
                'slug' => 'bat-an-cho-thu-cung',
                'type' => 2,
            ],
            [
                'name' => 'Đồ chơi cho chó',
                'img' => 'https://via.placeholder.com/640x480.png/00dd44?text=Đồ chơi cho chó',
                'purpose' => 'Đồ chơi giải trí cho chó',
                'slug' => 'do-choi-cho-cho',
                'type' => 3,
            ],
            [
                'name' => 'Xà phòng tắm cho mèo',
                'img' => 'https://via.placeholder.com/640x480.png/00ee55?text=Xà phòng tắm cho mèo',
                'purpose' => 'Giúp tắm rửa cho mèo sạch sẽ',
                'slug' => 'xa-phong-tam-cho-meo',
                'type' => 2,
            ],
        ]);
    }
}