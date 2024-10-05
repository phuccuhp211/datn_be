<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSpicesSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_spices')->insert([
            ['name' => 'Thịt gà'],
            ['name' => 'Thịt bò'],
            ['name' => 'Hải sản'],
        ]);
    }
}