<?php

namespace Database\Seeders;

use App\Models\TransactionDetailsOld;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionDetailsOldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionDetailsOld::factory(1000)->create();
    }
}
