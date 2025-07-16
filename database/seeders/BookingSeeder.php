<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Get some event packages and users
        $packages = EventPackage::all();
        $allUsers = User::all();

        if ($packages->count() > 0 && $allUsers->count() > 0) {
            // Create sample bookings
            $bookings = [
                [
                    'user_id' => $allUsers->random()->id,
                    'event_package_id' => $packages->random()->id,
                    'event_date' => Carbon::now()->addDays(15),
                    'location' => '123 Main Street, New Delhi, 110001',
                    'pin_code' => '110001',
                    'special_requests' => 'Please include extra balloons',
                    'guest_count' => 25,
                    'total_price' => 12000.00,
                    'status' => 'confirmed',
                    'created_at' => Carbon::now()->subDays(5),
                ],
                [
                    'user_id' => $allUsers->random()->id,
                    'event_package_id' => $packages->random()->id,
                    'event_date' => Carbon::now()->addDays(30),
                    'location' => '456 Oak Avenue, Mumbai, 400001',
                    'pin_code' => '400001',
                    'special_requests' => 'Princess theme with pink decorations',
                    'guest_count' => 30,
                    'total_price' => 15000.00,
                    'status' => 'confirmed',
                    'created_at' => Carbon::now()->subDays(3),
                ],
                [
                    'user_id' => $allUsers->random()->id,
                    'event_package_id' => $packages->random()->id,
                    'event_date' => Carbon::now()->addDays(7),
                    'location' => '789 Pine Road, Bangalore, 560001',
                    'pin_code' => '560001',
                    'special_requests' => 'Superhero theme for 5-year-old',
                    'guest_count' => 20,
                    'total_price' => 11500.00,
                    'status' => 'pending',
                    'created_at' => Carbon::now()->subDays(1),
                ],
                [
                    'user_id' => $allUsers->random()->id,
                    'event_package_id' => $packages->random()->id,
                    'event_date' => Carbon::now()->addDays(45),
                    'location' => '321 Cedar Lane, Chennai, 600001',
                    'pin_code' => '600001',
                    'special_requests' => 'Anniversary celebration with roses',
                    'guest_count' => 50,
                    'total_price' => 25000.00,
                    'status' => 'confirmed',
                    'created_at' => Carbon::now()->subDays(7),
                ],
                [
                    'user_id' => $allUsers->random()->id,
                    'event_package_id' => $packages->random()->id,
                    'event_date' => Carbon::now()->addDays(60),
                    'location' => '654 Maple Street, Hyderabad, 500001',
                    'pin_code' => '500001',
                    'special_requests' => 'Baby shower with pastel colors',
                    'guest_count' => 35,
                    'total_price' => 18000.00,
                    'status' => 'confirmed',
                    'created_at' => Carbon::now()->subDays(2),
                ],
            ];

            foreach ($bookings as $bookingData) {
                $booking = Booking::create($bookingData);

                // Create corresponding payment record
                Payment::create([
                    'booking_id' => $booking->id,
                    'payment_method' => 'cash',
                    'status' => $booking->status === 'confirmed' ? 'completed' : 'pending',
                    'amount' => $booking->total_price,
                    'transaction_id' => 'CASH_' . strtoupper(uniqid()),
                    'payment_date' => $booking->status === 'confirmed' ? $booking->created_at : now(),
                ]);
            }
        }
    }
}