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
                'name' => 'Pashmina',
                'description' => 'Bagus Banget',
                'price' => 10000,
            ],
            [
                'name' => 'Baju KOKO',
                'description' => 'Bagus Banget Sekali',
                'price' => 5000,
            ], [
                'name' => 'Celana Kulot',
                'description' => 'Bagus',
                'price' => 20000,
            ],
        ]);
    }
}
