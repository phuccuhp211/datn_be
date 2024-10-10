<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSpicesSeeder extends Seeder
{
    public function run()
    {
        $productSpices = [
            // Thức ăn cho thú cưng
            ['product_id' => 1, 'name' => 'Vị gà'],
            ['product_id' => 1, 'name' => 'Vị bò'],
            ['product_id' => 2, 'name' => 'Vị gà'],
            ['product_id' => 2, 'name' => 'Vị cá'],
            ['product_id' => 3, 'name' => 'Vị cá'],

            // Quần áo thú cưng
            ['product_id' => 6, 'name' => 'Cotton'],
            ['product_id' => 7, 'name' => 'Len'],
            ['product_id' => 8, 'name' => 'Chống nước'],
            ['product_id' => 9, 'name' => 'Thời trang'],
            ['product_id' => 10, 'name' => 'Cotton'],

            // Dụng cụ chăm sóc
            ['product_id' => 11, 'name' => 'Chất liệu nhựa'],
            ['product_id' => 12, 'name' => 'Thép không gỉ'],
            ['product_id' => 13, 'name' => 'Chất liệu cao su'],
            ['product_id' => 14, 'name' => 'Thép không gỉ'],
            ['product_id' => 15, 'name' => 'Dầu gội tự nhiên'],

            // Phụ kiện thú cưng
            ['product_id' => 16, 'name' => 'Chất liệu vải'],
            ['product_id' => 17, 'name' => 'Chất liệu nylon'],
            ['product_id' => 18, 'name' => 'Chất liệu nhựa'],
            ['product_id' => 19, 'name' => 'Chất liệu vải'],
            ['product_id' => 20, 'name' => 'Chất liệu cotton'],
        ];

        // Chèn dữ liệu vào bảng product_spices
        DB::table('product_spices')->insert($productSpices);
    }
}
