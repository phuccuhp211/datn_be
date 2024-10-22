<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCatalogsSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_catalogs')->insert([
            [
                'name' => 'Thức ăn',
                'slug' => 'thuc-an',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quần áo',
                'slug' => 'quan-ao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dụng cụ',
                'slug' => 'dung-cu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Đồ chơi thú cưng',
                'slug' => 'do-choi-thu-cung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
