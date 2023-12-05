<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction_details')->insert([
            [
                'transaction_id' => 1,
                'product_id' => 1,
                'quantity' => 10,
            ],
            [
                'transaction_id' => 1,
                'product_id' => 2,
                'quantity' => 5,
            ],
            [
                'transaction_id' => 1,
                'product_id' => 2,
                'quantity' => 7,
            ],
        ]);
    }
}
