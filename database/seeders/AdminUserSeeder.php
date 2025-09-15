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
            'email' => 'zuppiepurnea@gmail.com',
            'phone_no' => '7022323470',
            'password' => Hash::make('amit7352'), // Change this password
            'is_admin' => true,
        ]);
        $this->command->info('Admin user created successfully!');
    }
}




