<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCatalogsSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_catalogs')->insert([
            ['name' => 'Thực phẩm cho thú cưng', 'slug' => 'thuc-pham-cho-thu-cung'],
            ['name' => 'Dụng cụ chăm sóc', 'slug' => 'dung-cu-cham-soc'],
            ['name' => 'Đồ chơi cho thú cưng', 'slug' => 'do-choi-cho-thu-cung'],
        ]);
    }
}