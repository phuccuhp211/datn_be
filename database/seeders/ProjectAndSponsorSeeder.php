<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectAndSponsorSeeder extends Seeder
{
    public function run()
    {
        // Tạo dữ liệu mẫu cho bảng `projects`
        $projects = [
            [
                'name' => 'Cứu hộ chó mèo bị bỏ rơi tại Hà Nội',
                'description' => 'Hỗ trợ cứu hộ và chăm sóc chó mèo bị bỏ rơi ở khu vực Hà Nội.',
                'total_amount' => 50000000, // 50 triệu VND
                'raised_amount' => 20000000, // 20 triệu VND
                'project_image_url' => 'ungho1.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Xây dựng nhà tạm trú cho chó hoang',
                'description' => 'Dự án xây dựng nhà tạm trú cho chó hoang tại TP.HCM.',
                'total_amount' => 100000000, // 100 triệu VND
                'raised_amount' => 60000000, // 60 triệu VND
                'project_image_url' => 'ungho2.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Chăm sóc thú cưng bị thương tại Đà Nẵng',
                'description' => 'Hỗ trợ chăm sóc và phẫu thuật thú cưng bị thương.',
                'total_amount' => 30000000, // 30 triệu VND
                'raised_amount' => 15000000, // 15 triệu VND
                'project_image_url' => 'ungho3.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Phẫu thuật miễn phí cho động vật bị bệnh nặng',
                'description' => 'Dự án hỗ trợ phẫu thuật miễn phí cho các động vật bị bệnh nặng.',
                'total_amount' => 70000000, // 70 triệu VND
                'raised_amount' => 50000000, // 50 triệu VND
                'project_image_url' => 'ungho4.jpg',
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tiêm phòng và triệt sản miễn phí cho chó mèo',
                'description' => 'Chiến dịch tiêm phòng và triệt sản miễn phí trên toàn quốc.',
                'total_amount' => 200000000, // 200 triệu VND
                'raised_amount' => 120000000, // 120 triệu VND
                'project_image_url' => 'ungho5.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('projects')->insert($projects);

        // Tạo dữ liệu mẫu cho bảng `sponsors`
        $sponsors = [
            [
                'project_id' => 1,
                'email' => 'nguyenvana@example.com',
                'name' => 'Nguyễn Văn A',
                'amount' => 500000,
                'date' => Carbon::now()->subDays(10),
                'message' => 'Hy vọng các bé sớm được giúp đỡ.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 1,
                'email' => 'lethib@example.com',
                'name' => 'Lê Thị B',
                'amount' => 2000000,
                'date' => Carbon::now()->subDays(5),
                'message' => 'Mong dự án thành công.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 2,
                'email' => 'tranvand@example.com',
                'name' => 'Trần Văn D',
                'amount' => 3000000,
                'date' => Carbon::now()->subDays(7),
                'message' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 3,
                'email' => 'phamthic@example.com',
                'name' => 'Phạm Thị C',
                'amount' => 1500000,
                'date' => Carbon::now()->subDays(2),
                'message' => 'Chúc dự án lan tỏa yêu thương!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 4,
                'email' => 'dovane@example.com',
                'name' => 'Đỗ Văn E',
                'amount' => 1000000,
                'date' => Carbon::now()->subDays(1),
                'message' => 'Gửi chút tấm lòng.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 5,
                'email' => 'tranminhf@example.com',
                'name' => 'Trần Minh F',
                'amount' => 5000000,
                'date' => Carbon::now(),
                'message' => 'Mong các bé luôn khỏe mạnh.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('sponsors')->insert($sponsors);
    }
}