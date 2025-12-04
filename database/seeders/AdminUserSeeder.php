<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Change these credentials as needed
        $email = 'admin@techonika.com';
        $password = '123456789';

        // Create or update admin user
        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrator',
                'password' => Hash::make($password),
            ]
        );

        $this->command->info("Admin user seeded: {$email} / {$password}");
    }
}
