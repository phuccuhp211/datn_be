<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_sizes')->insert([
            ['size' => 'Nhỏ'],
            ['size' => 'Vừa'],
            ['size' => 'Lớn'],
        ]);
    }
}