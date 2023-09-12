<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'admin',
                'password' => 'password',
                'role' => '1'
            ]
        );
        User::updateOrCreate(
            [
                'email' => 'user@user.com',
            ],
            [
                'name' => 'user',
                'password' => 'password',
                'role' => '2'
            ]
        );
    }
}
