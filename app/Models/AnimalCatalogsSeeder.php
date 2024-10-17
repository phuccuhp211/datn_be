<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalCatalogsSeeder extends Seeder
{
    public function run()
    {
        $catalogs = [
            ['name' => 'Chó', 'slug' => 'cho'],
            ['name' => 'Mèo', 'slug' => 'meo'],
            ['name' => 'Thú cưng khác', 'slug' => 'thu-cung-khac'],
        ];

        foreach ($catalogs as $catalog) {
            DB::table('animal_catalogs')->insert([
                'name' => $catalog['name'],
                'slug' => $catalog['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}