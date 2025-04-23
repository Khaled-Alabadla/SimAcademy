<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Khaled Esam',
            'last_name' => 'Alabadla',
            'gender' => 'male',
            'nationality' => 'Palestine',
            'city' => 'Gaza',
            'phone' => '0593723192',
            'email' => 'admin@ut.com',
            'role' => 'admin',
            'password' => 'admin',
            'address' => 'Palestine',
            'zip' => '12345',
            'password' => Hash::make('admin'),
        ]);
    }
}
