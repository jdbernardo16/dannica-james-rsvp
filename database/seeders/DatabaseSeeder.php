<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GroupSeeder::class,
            GuestSeeder::class,
            RsvpSeeder::class,
        ]);

        // Create or update admin user
        User::firstOrCreate(
            ['email' => 'admin@jamesdannica.site'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => 1,
            ]
        );

        // Create or update regular test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );
    }
}
