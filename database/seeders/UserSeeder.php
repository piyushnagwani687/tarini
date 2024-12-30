<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt(12345678),
                'role' => 'admin',
                'phone' => '9879756435',
                'skills' => 'FrontEnd'
            ],
            [
                'name' => 'User',
                'email' => 'User@example.com',
                'password' => bcrypt(12345678),
                'role' => 'user',
                'phone' => '9087653421',
                'skills' => 'BackEnd'
            ]
        ]);
    }
}
