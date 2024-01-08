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
                'category_id' => 1,
                'size' => 'xl',
                'color' => 'grey',
                'stock' => 100,
                'image' => '313730343639313832382d61646d696e2d42616775732042616e676574.jpg',
            ],
            [
                'product_id' => 2,
                'category_id' => 1,
                'size' => 'l',
                'color' => 'grey',
                'stock' => 200,
                'image' => '313730343639313839342d61646d696e2d42616775732042616e6765742053656b616c69.jpg',
            ],
            [
                'product_id' => 3,
                'category_id' => 1,
                'size' => 'm',
                'color' => 'black',
                'stock' => 50,
                'image' => '313730343639313933332d61646d696e2d4261677573.jpg',
            ],
            [
                'product_id' => 4,
                'category_id' => 1,
                'size' => 'm',
                'color' => 'black',
                'stock' => 50,
                'image' => '313730343639323030362d61646d696e2d4261677573.jpg',
            ],
            [
                'product_id' => 5,
                'category_id' => 2,
                'size' => 'm',
                'color' => 'black',
                'stock' => 50,
                'image' => '313730343639323130392d61646d696e2d4261677573.jpg',
            ],
            [
                'product_id' => 6,
                'category_id' => 1,
                'size' => 'm',
                'color' => 'black',
                'stock' => 50,
                'image' => '313730343639323137342d61646d696e2d4261677573.webp',
            ],
        ]);
    }
}
