<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    public function run()
    {
    
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_no' => '+1234567890',
            'password' => Hash::make('admin123'), // Change this password
            'is_admin' => true,
        ]);


        $this->command->info('Admin user created successfully!');
    }
}




