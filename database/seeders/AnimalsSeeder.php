<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class AnimalsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');

        for ($i = 0; $i < 10; $i++) {
            $name = $faker->word;
            DB::table('animals')->insert([
                'type' => $faker->numberBetween(1, 3), // Chó, mèo, hoặc thú cưng khác
                'img' => $faker->imageUrl(640, 480, 'animals'),
                'name' => $name,
                'slug' => Str::slug($name),
                'age' => $faker->numberBetween(1, 15),
                'gender' => $faker->randomElement(['Đực', 'Cái']),
                'colors' => $faker->colorName(),
                'genitive' => $faker->word(),
                'health_info' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}