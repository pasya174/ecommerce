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
                'username' => 'Anggi',
                'first_name' => 'Anggi',
                'last_name' => 'Ayu',
                'email' => 'anggi@gmail.com',
                'password' => Hash::make('anggi123'),
                'points' => 2000,
                'total_points' => 2000,
                'role' => '',
            ],
            [
                'username' => 'Agus',
                'first_name' => 'Agus',
                'last_name' => 'Wibowo',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('agus123'),
                'points' => 900,
                'total_points' => 900,
                'role' => '',
            ],
            [
                'username' => 'Angga',
                'first_name' => 'Angga',
                'last_name' => 'Wijaya',
                'email' => 'Angga@gmail.com',
                'password' => Hash::make('angga123'),
                'points' => 5000,
                'total_points' => 5000,
                'role' => '',
            ],
            [
                'username' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'points' => 5000,
                'total_points' => 5000,
                'role' => 'admin',
            ],
        ]);
    }
}
