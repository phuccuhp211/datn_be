<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoriesSeeder extends Seeder
{
    public function run()
    {
        // Tạo các danh mục mẫu cụ thể
        $categories = [
            ['name' => 'Cứu hộ chó', 'index' => 1, 'language' => 'vi', 'slug' => 'cuu-ho-cho'],
            ['name' => 'Cứu hộ mèo', 'index' => 2, 'language' => 'vi', 'slug' => 'cuu-ho-meo'],
            ['name' => 'Câu chuyện giải cứu', 'index' => 3, 'language' => 'vi', 'slug' => 'cau-chuyen-giai-cuu'],
            ['name' => 'Hướng dẫn chăm sóc', 'index' => 4, 'language' => 'vi', 'slug' => 'huong-dan-cham-soc'],
        ];

        foreach ($categories as $category) {
            DB::table('story_catalogs')->insert(array_merge($category, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // Tạo 10 tin tức mẫu thuộc các danh mục trên
        $stories = [
            ['thumbnail' => 'new1.jpg', 'catalog_id' => 1, 'title' => 'Giải cứu chó con bị bỏ rơi ở ngoại ô', 'content' => 'Đội cứu hộ đã giải cứu thành công một chú chó con bị bỏ rơi...', 'author_id' => 1, 'date' => Carbon::now()->subDays(10), 'slug' => 'giai-cuu-cho-con-ngoai-o'],
            ['thumbnail' => 'new2.jpg', 'catalog_id' => 2, 'title' => 'Chú mèo đi lạc tìm lại được gia đình', 'content' => 'Sau nhiều ngày tìm kiếm, đội cứu hộ đã tìm thấy chú mèo...', 'author_id' => 1, 'date' => Carbon::now()->subDays(15), 'slug' => 'chu-meo-di-lac'],
            ['thumbnail' => 'new3.jpg', 'catalog_id' => 1, 'title' => 'Câu chuyện cảm động về một chú chó già bị bỏ rơi', 'content' => 'Một chú chó lớn tuổi đã được giải cứu và chăm sóc...', 'author_id' => 1, 'date' => Carbon::now()->subDays(8), 'slug' => 'chu-cho-gia-bi-bo-roi'],
            ['thumbnail' => 'new4.jpg', 'catalog_id' => 3, 'title' => 'Hành trình giải cứu thú cưng ở vùng lũ', 'content' => 'Đội cứu hộ đã vượt qua nhiều khó khăn để giải cứu...', 'author_id' => 1, 'date' => Carbon::now()->subDays(20), 'slug' => 'hanh-trinh-giai-cuu-vung-lu'],
            ['thumbnail' => 'new5.jpg', 'catalog_id' => 4, 'title' => 'Cách chăm sóc chó con sau khi giải cứu', 'content' => 'Hướng dẫn chi tiết về cách chăm sóc chó con bị bỏ rơi...', 'author_id' => 1, 'date' => Carbon::now()->subDays(5), 'slug' => 'cham-soc-cho-con-giai-cuu'],
            ['thumbnail' => 'new6.jpg', 'catalog_id' => 2, 'title' => 'Giải cứu mèo mẹ và đàn con tại khu công nghiệp', 'content' => 'Một mèo mẹ cùng đàn con đã được đội cứu hộ giải cứu...', 'author_id' => 1, 'date' => Carbon::now()->subDays(12), 'slug' => 'giai-cuu-meo-me-khu-cong-nghiep'],
            ['thumbnail' => 'new7.jpg', 'catalog_id' => 3, 'title' => 'Câu chuyện về những chú chó giải cứu từ nhà hoang', 'content' => 'Những chú chó bị bỏ rơi trong nhà hoang đã được tìm thấy...', 'author_id' => 1, 'date' => Carbon::now()->subDays(9), 'slug' => 'cho-giai-cuu-nha-hoang'],
            ['thumbnail' => 'new8.jpg', 'catalog_id' => 4, 'title' => 'Chăm sóc mèo bị bệnh sau khi cứu hộ', 'content' => 'Hướng dẫn cách chăm sóc mèo bị bệnh để phục hồi...', 'author_id' => 1, 'date' => Carbon::now()->subDays(7), 'slug' => 'cham-soc-meo-bi-benh'],
            ['thumbnail' => 'new9.jpg', 'catalog_id' => 1, 'title' => 'Giải cứu chó bị mắc kẹt trên mái nhà', 'content' => 'Một chú chó đã được giải cứu an toàn sau khi bị mắc kẹt...', 'author_id' => 1, 'date' => Carbon::now()->subDays(18), 'slug' => 'cho-mac-ket-mai-nha'],
            ['thumbnail' => 'new10.jpg', 'catalog_id' => 3, 'title' => 'Câu chuyện xúc động về một chú mèo cứu hộ', 'content' => 'Một chú mèo nhỏ được giải cứu từ đường phố...', 'author_id' => 1, 'date' => Carbon::now()->subDays(3), 'slug' => 'meo-cuu-ho-duong-pho'],
        ];

        foreach ($stories as $story) {
            DB::table('stories')->insert(array_merge($story, [
                'language' => 'vi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
