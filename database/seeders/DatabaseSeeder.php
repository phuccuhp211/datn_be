<?php

namespace Database\Seeders;

use App\Models\ProductSpice;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ProductCatalogsSeeder::class,
            StoryCatalogsSeeder::class,
            AnimalCatalogsSeeder::class,
            AnimalsSeeder::class,
            UsersSeeder::class,
            ProductsSeeder::class,
            StoriesSeeder::class,



        ]);
    }
}
