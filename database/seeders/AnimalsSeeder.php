<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalsSeeder extends Seeder
{
    public function run()
    {
        DB::table('animals')->insert([
            [
                'type' => 1,
                'img' => 'dog1.jpg',
                'name' => 'Bông',
                'age' => 3,
                'gender' => 'Đực',
                'colors' => 'Trắng',
                'genitive' => 'Poodle',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-09-10'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'bong',
            ],
            [
                'type' => 2,
                'img' => 'cat1.jpg',
                'name' => 'Miu',
                'age' => 2,
                'gender' => 'Cái',
                'colors' => 'Vàng',
                'genitive' => 'Mèo ta',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-08-15'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'miu',
            ],
            [
                'type' => 1,
                'img' => 'dog2.jpg',
                'name' => 'Đốm',
                'age' => 4,
                'gender' => 'Đực',
                'colors' => 'Đen và trắng',
                'genitive' => 'Chihuahua',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'DTP'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-07-20'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'dom',
            ],
            [
                'type' => 2,
                'img' => 'cat2.jpg',
                'name' => 'Mít',
                'age' => 1,
                'gender' => 'Cái',
                'colors' => 'Đen',
                'genitive' => 'Mèo Ba Tư',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'FVRCP'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-09-01'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'mit',
            ],
            [
                'type' => 1,
                'img' => 'dog3.jpg',
                'name' => 'Vàng',
                'age' => 5,
                'gender' => 'Đực',
                'colors' => 'Vàng',
                'genitive' => 'Corgi',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-06-10'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'vang',
            ],
            [
                'type' => 2,
                'img' => 'cat3.jpg',
                'name' => 'Sữa',
                'age' => 3,
                'gender' => 'Cái',
                'colors' => 'Trắng',
                'genitive' => 'Mèo Anh lông ngắn',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-07-05'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'sua',
            ],
            [
                'type' => 1,
                'img' => 'dog4.jpg',
                'name' => 'Nâu',
                'age' => 2,
                'gender' => 'Đực',
                'colors' => 'Nâu',
                'genitive' => 'Golden Retriever',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó', 'DTP'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-08-20'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'nau',
            ],
            [
                'type' => 2,
                'img' => 'cat4.jpg',
                'name' => 'Mun',
                'age' => 4,
                'gender' => 'Đực',
                'colors' => 'Xám',
                'genitive' => 'Mèo Nga',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'FVRCP'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-09-15'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'mun',
            ],
            [
                'type' => 1,
                'img' => 'dog5.jpg',
                'name' => 'Mực',
                'age' => 3,
                'gender' => 'Đực',
                'colors' => 'Đen',
                'genitive' => 'Shiba Inu',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-05-10'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'muc',
            ],
            [
                'type' => 2,
                'img' => 'cat5.jpg',
                'name' => 'Mướp',
                'age' => 2,
                'gender' => 'Cái',
                'colors' => 'Xám và trắng',
                'genitive' => 'Mèo ta',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-07-25'
                ]),
                'user_id' => null,
                'language' => 'vi',
                'slug' => 'muop',
            ]
        ]);
    }
}