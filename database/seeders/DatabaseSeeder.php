<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Optionnel : création d’un utilisateur test
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            AdminUserSeeder::class,
        ]);

        // Appelle le seeder du jeu
        $this->call(GameSeeder::class);
    }
}
