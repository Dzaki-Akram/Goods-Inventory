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

        User::where('email', 'admin@2025.com')->delete();
        User::where('email', 'manager@2025.com')->delete();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@2025.com',
            'password' => Hash::make('123456'),
        ]);
        $admin->assignRole('Admin');

        $user = User::create([
            'name' => 'Manager',
            'email' => 'manager@2025.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole('User');
    }
}
