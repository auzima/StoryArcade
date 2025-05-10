<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@test.com'], // critère unique
            [
                'name' => 'Admin',
                'password' => bcrypt('adminpass'),
                'admin' => true,
            ]
        );
    }
}




