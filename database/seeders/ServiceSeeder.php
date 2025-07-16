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
            '110001', // Connaught Place, Delhi
            '110002', // Darya Ganj, Delhi
            '110003', // Anand Parbat, Delhi
            '110004', // Raghubir Nagar, Delhi
            '110005', // Karol Bagh, Delhi
            '110006', // Ramnagar, Delhi
            '110007', // Rajender Nagar, Delhi
            '110008', // Patel Nagar, Delhi
            '110009', // RK Ashram Marg, Delhi
            '110010', // Paharganj, Delhi
            '110011', // Shastri Nagar, Delhi
            '110012', // Ashok Nagar, Delhi
            '400001', // Fort, Mumbai
            '400002', // Kalbadevi, Mumbai
            '400003', // Mumbai Central, Mumbai
            '400004', // Girgaon, Mumbai
            '400005', // Ballard Estate, Mumbai
            '700001', // BBD Bag, Kolkata
            '700002', // Bowbazar, Kolkata
            '700003', // Kolkata Central, Kolkata
            '600001', // Parry's, Chennai
            '600002', // Sowcarpet, Chennai
            '600003', // Chepauk, Chennai
            '500001', // Afzal Gunj, Hyderabad
            '500002', // Saidabad, Hyderabad
            '500003', // Himayat Nagar, Hyderabad
            '560001', // Bangalore City, Bangalore
            '560002', // Bangalore South, Bangalore
            '560003', // Malleshwaram, Bangalore
            '411001', // Pune City, Pune
            '411002', // Parvati, Pune
            '411003', // Pune Cantt, Pune
            
            // User requested pin codes
            '854301', // Purnia, Bihar
            '854302', // Purnia East, Bihar
        ];

        foreach ($pinCodes as $pinCode) {
            Service::create(['pin_code' => $pinCode]);
        }
    }
}
