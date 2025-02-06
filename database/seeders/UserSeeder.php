<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            'name' => 'Super Admin',
            'email' => 'admin@ticketkenya.com',
            'password' => bcrypt('Dimetech@2025'),
            'role' => 'admin',
            'phone_number' => '254708178500'

        ];

        $added = 0;
        $skipped = 0;

        // Check if the user already exists
        if (!DB::table('users')->where('email', $adminData['email'])->exists()) {
            DB::table('users')->insert($adminData);
            $added++;
        } else {
            $skipped++;
        }

        $this->command->info("Added $added admin user(s) and skipped $skipped.");
    }
}
