<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCatalogsSeeder extends Seeder
{
    public function run()
    {
        $catalogs = [
            ['name' => 'Thức ăn cho thú cưng', 'slug' => Str::slug('Thức ăn cho thú cưng'), 'language' => 'vi'],
            ['name' => 'Phụ kiện thú cưng', 'slug' => Str::slug('Phụ kiện thú cưng'), 'language' => 'vi'],
            ['name' => 'Dụng cụ chăm sóc', 'slug' => Str::slug('Dụng cụ chăm sóc'), 'language' => 'vi'],
            ['name' => 'Quần áo thú cưng', 'slug' => Str::slug('Quần áo thú cưng'), 'language' => 'vi'],
            ['name' => 'Thuốc & Sản phẩm y tế', 'slug' => Str::slug('Thuốc & Sản phẩm y tế'), 'language' => 'vi'],
        ];

        DB::table('product_catalogs')->insert($catalogs);
    }
}
