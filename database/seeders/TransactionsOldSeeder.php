<?php

namespace Database\Seeders;

use App\Models\TransactionsOld;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsOldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionsOld::factory(env('TOTAL_DATA_OLD'))->create();
    }
}
