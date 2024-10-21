<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // Khởi tạo Faker

        for ($i = 0; $i < 20; $i++) { // Tạo 20 người dùng giả
            DB::table('users')->insert([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'role' => $faker->randomElement(['admin', 'user']),
                'rescue_cases' => $faker->numberBetween(0, 100), // Số vụ cứu hộ ngẫu nhiên
                'adopted' => $faker->numberBetween(0, 50), // Số vụ nhận nuôi ngẫu nhiên
                'password' => bcrypt('password'), // Mật khẩu đã mã hóa
                'created_at' => now(), // Thời gian tạo
                'updated_at' => now(), // Thời gian cập nhật
            ]);
        }
    }
}