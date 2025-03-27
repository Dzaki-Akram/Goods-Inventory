<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama hanya untuk email yang digunakan dalam seeder
        User::where('email', 'admin@2025.com')->delete();
        User::where('email', 'manager@2025.com')->delete();

        // User admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@2025.com',
            'password' => Hash::make('123456'),
        ]);
        $admin->assignRole('Admin');

        // Contoh user biasa
        $user = User::create([
            'name' => 'Manager',
            'email' => 'manager@2025.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole('User');
    }
}
