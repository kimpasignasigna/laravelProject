<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Adjust if using a different model

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Check if the admin already exists
            [
                'name' => 'Kim Pasignasigna',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@123'), // Change this to a secure password
                'role' => 'admin', // If you have roles
                'skill' => 'Welcome',
                'skill2' => 'This is my Project',
                'skill3' => 'Admin',
                'skill4' => 'IT Student',
            ]
        );
    }
}