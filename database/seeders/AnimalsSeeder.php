<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;
use App\Models\Image;

class AnimalsSeeder extends Seeder
{
    public function run()
    {
        $animals = [
            [
                'type' => 1,
                'name' => 'Bông',
                'age' => 3,
                'weight' => 5,
                'status' => 'no-owned',
                'gender' => 'Đực',
                'colors' => 'Trắng',
                'genitive' => 'Poodle',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-09-10'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'bong',
                'images' => ['dog1.jpg'] // Danh sách hình ảnh của động vật
            ],
            [
                'type' => 2,
                'name' => 'Miu',
                'age' => 2,
                'status' => 'no-owned',
                'weight' => 7,
                'gender' => 'Cái',
                'colors' => 'Vàng',
                'genitive' => 'Mèo ta',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-08-15'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'miu',
                'images' => ['cat1.jpg']
            ],
            [
                'type' => 1,
                'name' => 'Đốm',
                'age' => 4,
                'status' => 'no-owned',
                'weight' => 3,
                'gender' => 'Đực',
                'colors' => 'Đen và trắng',
                'genitive' => 'Chihuahua',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'DTP'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-07-20'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'dom',
                'images' => ['dog2.jpg']
            ],
            [
                'type' => 2,
                'name' => 'Mít',
                'age' => 1,
                'status' => 'no-owned',
                'weight' => 3,
                'gender' => 'Cái',
                'colors' => 'Đen',
                'genitive' => 'Mèo Ba Tư',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'FVRCP'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-09-01'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'mit',
                'images' => ['cat2.jpg']
            ],
            [
                'type' => 1,
                'name' => 'Vàng',
                'age' => 5,
                'status' => 'no-owned',
                'weight' => 7,
                'gender' => 'Đực',
                'colors' => 'Vàng',
                'genitive' => 'Corgi',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-06-10'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'vang',
                'images' => ['dog3.jpg']
            ],
            [
                'type' => 2,
                'name' => 'Sữa',
                'age' => 3,
                'weight' => 9,
                'status' => 'no-owned',
                'gender' => 'Cái',
                'colors' => 'Trắng',
                'genitive' => 'Mèo Anh lông ngắn',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-07-05'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'sua',
                'images' => ['cat3.jpg']
            ],
            [
                'type' => 1,
                'name' => 'Nâu',
                'age' => 2,
                'weight' => 5,
                'status' => 'no-owned',
                'gender' => 'Đực',
                'colors' => 'Nâu',
                'genitive' => 'Golden Retriever',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó', 'DTP'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-08-20'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'nau',
                'images' => ['dog4.jpg']
            ],
            [
                'type' => 2,
                'name' => 'Mun',
                'age' => 4,
                'weight' => 5,
                'status' => 'no-owned',
                'gender' => 'Đực',
                'colors' => 'Xám',
                'genitive' => 'Mèo Nga',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'FVRCP'],
                    'health_status' => 'Bình thường',
                    'last_checkup' => '2024-09-15'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'mun',
                'images' => ['cat4.jpg']
            ],
            [
                'type' => 1,
                'name' => 'Mực',
                'age' => 3,
                'status' => 'no-owned',
                'weight' => 9,
                'gender' => 'Đực',
                'colors' => 'Đen',
                'genitive' => 'Shiba Inu',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Cúm chó'],
                    'health_status' => 'Tốt',
                    'last_checkup' => '2024-05-10'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'muc',
                'images' => ['dog5.jpg']
            ],
            [
                'type' => 2,
                'name' => 'Mướp',
                'age' => 2,
                'status' => 'no-owned',
                'weight' => 6,
                'gender' => 'Cái',
                'colors' => 'Xám và trắng',
                'genitive' => 'Mèo ta',
                'health_info' => json_encode([
                    'vaccinations' => ['Dại', 'Lepto'],
                    'health_status' => 'Khỏe mạnh',
                    'last_checkup' => '2024-07-25'
                ]),
                'form_request_id' => null,
                'language' => 'vi',
                'slug' => 'muop',
                'images' => ['cat5.jpg']
            ]
        ];

        foreach ($animals as $animalData) {
            // Insert animal data
            $animal = Animal::create([
                'type' => $animalData['type'],
                'name' => $animalData['name'],
                'age' => $animalData['age'],
                'status' => $animalData['status'],
                'weight' => $animalData['weight'],
                'gender' => $animalData['gender'],
                'colors' => $animalData['colors'],
                'genitive' => $animalData['genitive'],
                'health_info' => $animalData['health_info'],
                'form_request_id' => $animalData['form_request_id'],
                'language' => $animalData['language'],
                'slug' => $animalData['slug']
            ]);

            // Insert corresponding images for each animal
            foreach ($animalData['images'] as $imageUrl) {
                Image::create([
                    'url' => $imageUrl,
                    'reference_id' => $animal->id,
                    'table' => 'animals'
                ]);
            }
        }
    }
}