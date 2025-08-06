<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pinCodes = [
            
            // User requested pin codes
            '854301', // Purnia, Bihar
            '854302', // Purnia East, Bihar
        ];

        foreach ($pinCodes as $pinCode) {
            Service::create(['pin_code' => $pinCode]);
        }
    }
}
