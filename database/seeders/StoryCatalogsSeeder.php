<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoryCatalogsSeeder extends Seeder
{
    public function run()
    {
        $catalogs = [
            ['name' => 'Câu chuyện về thú cưng', 'slug' => 'cau-chuyen-ve-thu-cung', 'index' => 1],
            ['name' => 'Câu chuyện cứu hộ', 'slug' => 'cau-chuyen-cuu-ho', 'index' => 2],
            ['name' => 'Câu chuyện nhận nuôi', 'slug' => 'cau-chuyen-nhan-nuoi', 'index' => 3],
        ];

        foreach ($catalogs as $catalog) {
            DB::table('story_catalogs')->insert([
                'name' => $catalog['name'],
                'slug' => $catalog['slug'],
                'index' => $catalog['index'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}