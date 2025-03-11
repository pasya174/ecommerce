<?php

namespace Database\Seeders;

set_time_limit(300);

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
