<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesSeeder extends Seeder
{
    public function run()
    {
        $productSizes = [
            // Thức ăn cho thú cưng
            ['product_id' => 1, 'size' => '1kg', 'price' => 50000, 'discount_price' => 45000],
            ['product_id' => 1, 'size' => '5kg', 'price' => 200000, 'discount_price' => 180000],
            ['product_id' => 2, 'size' => '1kg', 'price' => 55000, 'discount_price' => null],
            ['product_id' => 2, 'size' => '5kg', 'price' => 210000, 'discount_price' => 200000],
            ['product_id' => 3, 'size' => '1kg', 'price' => 60000, 'discount_price' => null],

            // Quần áo thú cưng
            ['product_id' => 6, 'size' => 'S', 'price' => 150000, 'discount_price' => 135000],
            ['product_id' => 6, 'size' => 'M', 'price' => 180000, 'discount_price' => null],
            ['product_id' => 7, 'size' => 'S', 'price' => 160000, 'discount_price' => null],
            ['product_id' => 8, 'size' => 'M', 'price' => 170000, 'discount_price' => 160000],
            ['product_id' => 9, 'size' => 'L', 'price' => 200000, 'discount_price' => null],

            // Dụng cụ chăm sóc
            ['product_id' => 11, 'size' => 'Một kích thước', 'price' => 30000, 'discount_price' => null],
            ['product_id' => 12, 'size' => 'Một kích thước', 'price' => 80000, 'discount_price' => 75000],
            ['product_id' => 13, 'size' => 'Một kích thước', 'price' => 100000, 'discount_price' => null],
            ['product_id' => 14, 'size' => 'Một kích thước', 'price' => 150000, 'discount_price' => 140000],
            ['product_id' => 15, 'size' => 'Một kích thước', 'price' => 50000, 'discount_price' => null],

            // Phụ kiện thú cưng
            ['product_id' => 16, 'size' => 'Một kích thước', 'price' => 60000, 'discount_price' => null],
            ['product_id' => 17, 'size' => 'Một kích thước', 'price' => 70000, 'discount_price' => null],
            ['product_id' => 18, 'size' => 'Một kích thước', 'price' => 50000, 'discount_price' => null],
            ['product_id' => 19, 'size' => 'Một kích thước', 'price' => 120000, 'discount_price' => null],
            ['product_id' => 20, 'size' => 'Một kích thước', 'price' => 30000, 'discount_price' => null],
        ];

        // Chèn dữ liệu vào bảng product_sizes
        DB::table('product_sizes')->insert($productSizes);
    }
}
