<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Create admin user
        User::create([
            'name'          => 'Administrator',
            'username'      => 'admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('password123'),
            'role'          => 'admin',
            'phone'         => '081234567890',
            'address'       => 'Jl. Admin No. 1',
            'is_active'     => true,
        ]);

        // Create sample kasir users
        User::create([
            'name'          => 'Kasir 1',
            'username'      => 'kasir1',
            'email'         => 'kasir1@gmail.com',
            'password'      => Hash::make('kasir123'),
            'role'          => 'kasir',
            'phone'         => '081234567891',
            'address'       => 'Jl. Kasir No. 1',
            'is_active'     => true,
        ]);

        User::create([
            'name'          => 'Kasir 2',
            'username'      => 'kasir2',
            'email'         => 'kasir2@gmail.com',
            'password'      => Hash::make('kasir123'),
            'role'          => 'kasir',
            'phone'         => '081234567892',
            'address'       => 'Jl. Kasir No. 2',
            'is_active'     => true,
        ]);
    }
}