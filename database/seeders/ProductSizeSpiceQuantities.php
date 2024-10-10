<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSpiceQuantities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productSizeSpiceQuantities = [
            // Thức ăn cho thú cưng
            ['product_size_id' => 1, 'product_spice_id' => 1, 'quantity' => 100],
            ['product_size_id' => 1, 'product_spice_id' => 2, 'quantity' => 80],
            ['product_size_id' => 3, 'product_spice_id' => 1, 'quantity' => 90],

            // Quần áo thú cưng
            ['product_size_id' => 6, 'product_spice_id' => 1, 'quantity' => 50],
            ['product_size_id' => 7, 'product_spice_id' => 2, 'quantity' => 40],
            ['product_size_id' => 8, 'product_spice_id' => 3, 'quantity' => 30],

            // Dụng cụ chăm sóc
            ['product_size_id' => 11, 'product_spice_id' => 1, 'quantity' => 20],
            ['product_size_id' => 12, 'product_spice_id' => 2, 'quantity' => 25],
            ['product_size_id' => 13, 'product_spice_id' => 3, 'quantity' => 15],

            // Phụ kiện thú cưng
            ['product_size_id' => 16, 'product_spice_id' => 1, 'quantity' => 70],
            ['product_size_id' => 17, 'product_spice_id' => 2, 'quantity' => 60],
            ['product_size_id' => 18, 'product_spice_id' => 3, 'quantity' => 50],
        ];

        // Chèn dữ liệu vào bảng product_size_spice_quantity
        DB::table('product_size_spice_quantity')->insert($productSizeSpiceQuantities);
    }
}
