<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Abaya',
                'description' => 'Bagus Banget',
                'price' => 10000,
            ],
            [
                'name' => 'Gamis',
                'description' => 'Bagus Banget Sekali',
                'price' => 10000,
            ],
            [
                'name' => 'Hanbok',
                'description' => 'Bagus',
                'price' => 10000,
            ],
            [
                'name' => 'Kaftan',
                'description' => 'Bagus',
                'price' => 10000,
            ],
            [
                'name' => 'Pasmina',
                'description' => 'Bagus',
                'price' => 10000,
            ],
            [
                'name' => 'Tunik',
                'description' => 'Bagus',
                'price' => 10000,
            ],
        ]);
    }
}
