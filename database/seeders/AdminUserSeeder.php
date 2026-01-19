<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin123'],

            [
                'name' => 'root',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
