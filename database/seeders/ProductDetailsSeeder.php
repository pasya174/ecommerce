<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_details')->insert([
            [
                'product_id' => 1,
                'category_id' => 2,
                'size' => 'XL',
                'color' => 'grey',
                'stock' => 100,
            ],
            [
                'product_id' => 2,
                'category_id' => 1,
                'size' => 'XL',
                'color' => 'grey',
                'stock' => 200,
            ],
            [
                'product_id' => 3,
                'category_id' => 2,
                'size' => 'XL',
                'color' => 'black',
                'stock' => 50,
            ],
        ]);
    }
}
