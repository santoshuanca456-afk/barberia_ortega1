<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario global admin
        User::factory()->create([
            'first_name' => 'Santos',
            'middle_name' => 'Huanca',
            'last_name' => 'Limachi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'global_admin',
            'status' => 1,
            'phone_number' => '+446545748844',
            'address' => '123 Main Street, Springfield',
        ]);

        // Crear usuario admin de prueba
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'prueba@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'status' => 1,
        ]);

        // Crear algunos usuarios customer
        User::factory(5)->customer()->create();
    }
}