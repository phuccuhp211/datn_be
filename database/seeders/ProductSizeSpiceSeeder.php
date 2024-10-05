<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSpiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_size_spice')->insert([
            ['product_id' => 1, 'product_size_id' => 1, 'product_spice_id' => 1, 'price' => 50000, 'quantity' => 100],
            ['product_id' => 1, 'product_size_id' => 1, 'product_spice_id' => 2, 'price' => 50000, 'quantity' => 80],
            ['product_id' => 2, 'product_size_id' => 2, 'product_spice_id' => 1, 'price' => 70000, 'quantity' => 50],
            ['product_id' => 2, 'product_size_id' => 2, 'product_spice_id' => 3, 'price' => 70000, 'quantity' => 70],
            ['product_id' => 3, 'product_size_id' => 3, 'product_spice_id' => 1, 'price' => 60000, 'quantity' => 60],
            // Thêm dữ liệu mẫu cho các sản phẩm khác
        ]);
    }
}