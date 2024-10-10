<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Thức ăn cho thú cưng
            ['img' => 'image/thuc-an-cho-cho-1.webp', 'name' => 'Thức ăn cho chó vị gà', 'type' => 1, 'purpose' => 'Cung cấp dinh dưỡng cho chó', 'language' => 'vi', 'slug' => Str::slug('Thức ăn cho chó vị gà')],
            ['img' => 'image/thuc-an-cho-cho-2.webp', 'name' => 'Thức ăn cho chó vị bò', 'type' => 1, 'purpose' => 'Cung cấp dinh dưỡng cho chó', 'language' => 'vi', 'slug' => Str::slug('Thức ăn cho chó vị bò')],
            ['img' => 'image/thuc-an-cho-cho-3.webp', 'name' => 'Thức ăn cho chó vị cá', 'type' => 1, 'purpose' => 'Cung cấp dinh dưỡng cho chó', 'language' => 'vi', 'slug' => Str::slug('Thức ăn cho chó vị cá')],
            ['img' => 'image/thuc-an-cho-meo-1.webp', 'name' => 'Thức ăn cho mèo vị cá', 'type' => 1, 'purpose' => 'Cung cấp dinh dưỡng cho mèo', 'language' => 'vi', 'slug' => Str::slug('Thức ăn cho mèo vị cá')],
            ['img' => 'image/thuc-an-cho-meo-2.webp', 'name' => 'Thức ăn cho mèo vị gà', 'type' => 1, 'purpose' => 'Cung cấp dinh dưỡng cho mèo', 'language' => 'vi', 'slug' => Str::slug('Thức ăn cho mèo vị gà')],

            // Quần áo thú cưng
            ['img' => 'image/ao-1.jpg', 'name' => 'Áo khoác mùa đông', 'type' => 4, 'purpose' => 'Giữ ấm cho thú cưng', 'language' => 'vi', 'slug' => Str::slug('Áo khoác mùa đông')],
            ['img' => 'image/ao-2.jpg', 'name' => 'Áo len cho chó', 'type' => 4, 'purpose' => 'Áo ấm cho chó vào mùa đông', 'language' => 'vi', 'slug' => Str::slug('Áo len cho chó')],
            ['img' => 'image/ao-3.jpg', 'name' => 'Áo mưa cho thú cưng', 'type' => 4, 'purpose' => 'Bảo vệ thú cưng khỏi mưa', 'language' => 'vi', 'slug' => Str::slug('Áo mưa cho thú cưng')],
            ['img' => 'image/ao-4.jpg', 'name' => 'Giày cho thú cưng', 'type' => 4, 'purpose' => 'Bảo vệ chân thú cưng', 'language' => 'vi', 'slug' => Str::slug('Giày cho thú cưng')],
            ['img' => 'image/ao-5.jpg', 'name' => 'Áo hoodie cho thú cưng', 'type' => 4, 'purpose' => 'Áo thời trang cho thú cưng', 'language' => 'vi', 'slug' => Str::slug('Áo hoodie cho thú cưng')],

            // Dụng cụ chăm sóc
            ['img' => 'image/dung-cu-1.jpg', 'name' => 'Bàn chải lông thú', 'type' => 3, 'purpose' => 'Chăm sóc lông thú cưng', 'language' => 'vi', 'slug' => Str::slug('Bàn chải lông thú')],
            ['img' => 'image/dung-cu-2.jpg', 'name' => 'Kéo cắt lông', 'type' => 3, 'purpose' => 'Cắt tỉa lông thú cưng', 'language' => 'vi', 'slug' => Str::slug('Kéo cắt lông thú')],
            ['img' => 'image/dung-cu-3.jpg', 'name' => 'Găng tay tắm cho thú cưng', 'type' => 3, 'purpose' => 'Tắm cho thú cưng dễ dàng hơn', 'language' => 'vi', 'slug' => Str::slug('Găng tay tắm cho thú cưng')],
            ['img' => 'image/dung-cu-4.jpg', 'name' => 'Máy sấy lông thú', 'type' => 3, 'purpose' => 'Sấy khô lông thú cưng', 'language' => 'vi', 'slug' => Str::slug('Máy sấy lông thú')],
            ['img' => 'image/dung-cu-5.jpg', 'name' => 'Dầu gội cho thú cưng', 'type' => 3, 'purpose' => 'Dầu gội an toàn cho thú cưng', 'language' => 'vi', 'slug' => Str::slug('Dầu gội cho thú cưng')],

            // Phụ kiện thú cưng
            ['img' => 'image/phu-kien-1.jpg', 'name' => 'Cổ dây dắt chó màu đỏ', 'type' => 2, 'purpose' => 'Dụng cụ dắt thú cưng', 'language' => 'vi', 'slug' => Str::slug('Cổ dây dắt chó màu đỏ')],
            ['img' => 'image/phu-kien-2.jpg', 'name' => 'Cổ dây dắt chó màu xanh', 'type' => 2, 'purpose' => 'Dụng cụ dắt thú cưng', 'language' => 'vi', 'slug' => Str::slug('Cổ dây dắt chó màu xanh')],
            ['img' => 'image/phu-kien-3.jpg', 'name' => 'Dây dắt chó dài', 'type' => 2, 'purpose' => 'Dụng cụ dắt thú cưng', 'language' => 'vi', 'slug' => Str::slug('Dây dắt chó dài')],
            ['img' => 'image/phu-kien-4.jpg', 'name' => 'Giỏ xách cho chó', 'type' => 2, 'purpose' => 'Giỏ xách cho thú cưng', 'language' => 'vi', 'slug' => Str::slug('Giỏ xách cho chó')],
            ['img' => 'image/phu-kien-5.jpg', 'name' => 'Khăn tắm cho thú cưng', 'type' => 2, 'purpose' => 'Khăn tắm cho thú cưng', 'language' => 'vi', 'slug' => Str::slug('Khăn tắm cho thú cưng')],
        ];

        // Chèn dữ liệu vào bảng products
        DB::table('products')->insert($products);
    }
}
