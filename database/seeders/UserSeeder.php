<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Santos',
            'middle_name' => 'Huanca',
            'last_name' => 'Limachi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'global_admin',
            'status' => 1,
            'notice' => null, // Campo agregado que falta en tu estructura
            'phone_number' => '+446545748844',
            'address' => '123 Main Street, Springfield',
            'profile_picture' => null,
            'activation_token' => null,
            'remember_token' => null,
            'two_factor_auth' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Opcional: agregar más usuarios de prueba
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'prueba@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 1,
            'notice' => null,
            'phone_number' => '+1234567890',
            'address' => 'Admin Address',
            'profile_picture' => null,
            'activation_token' => null,
            'remember_token' => null,
            'two_factor_auth' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}