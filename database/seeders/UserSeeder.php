<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Anggi',
                'email' => 'anggi@gmail.com',
                'password' => Hash::make('anggi123'),
                'points' => 10
            ],
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('agus123'),
                'points' => 5
            ], [
                'name' => 'Angga',
                'email' => 'Angga@gmail.com',
                'password' => Hash::make('anggi123'),
                'points' => 0
            ],
        ]);
    }
}
