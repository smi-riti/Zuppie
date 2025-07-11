<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Create categories if they don't exist
        $categories = [
            ['name' => 'Wedding', 'description' => 'Wedding events and ceremonies'],
            ['name' => 'Birthday', 'description' => 'Birthday parties and celebrations'],
            ['name' => 'Corporate', 'description' => 'Corporate events and meetings'],
            ['name' => 'Conference', 'description' => 'Conferences and seminars'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Create event packages with realistic data
        $packages = [
            [
                'name' => 'Premium Wedding Package',
                'price' => 2999.99,
                'category_id' => Category::where('name', 'Wedding')->first()->id,
                'description' => 'Complete wedding package with premium services',
                'duration' => 8, // hours
                'is_active' => true,
                'is_special' => true
            ],
            [
                'name' => 'Standard Birthday Package',
                'price' => 999.99,
                'category_id' => Category::where('name', 'Birthday')->first()->id,
                'description' => 'Standard birthday celebration package',
                'duration' => 4, // hours
                'is_active' => true,
                'is_special' => false
            ],
            [
                'name' => 'Corporate Event Basic',
                'price' => 1999.99,
                'category_id' => Category::where('name', 'Corporate')->first()->id,
                'description' => 'Basic package for corporate events',
                'duration' => 6, // hours
                'is_active' => true,
                'is_special' => false
            ],
            [
                'name' => 'Conference Deluxe',
                'price' => 3999.99,
                'category_id' => Category::where('name', 'Conference')->first()->id,
                'description' => 'Deluxe conference package with all amenities',
                'duration' => 8, // hours
                'is_active' => true,
                'is_special' => true
            ],
        ];

        foreach ($packages as $package) {
            EventPackage::firstOrCreate(['name' => $package['name']], $package);
        }

        // Create test users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone_no' => '1234567890',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone_no' => '0987654321',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'phone_no' => '1122334455',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
            [
                'name' => 'Bob Williams',
                'email' => 'bob@example.com',
                'phone_no' => '5566778899',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        // Create sample bookings
        $statuses = ['pending', 'confirmed', 'cancelled']; // Matches your migration enum
        $locations = [
            'Grand Ballroom, Hotel Taj',
            'Convention Center, Downtown',
            'Beachside Resort, Malibu',
            'Garden Pavilion, Central Park',
            'Rooftop Terrace, City View Hotel'
        ];
        $specialRequests = [
            'Vegetarian meal options required',
            'Wheelchair accessibility needed',
            'Minimal decoration preferred',
            'AV equipment required',
            'Special cake at midnight',
            null
        ];

        for ($i = 0; $i < 50; $i++) {
            $user = User::where('is_admin', false)->inRandomOrder()->first();
            $package = EventPackage::inRandomOrder()->first();
            
            $eventDate = Carbon::now()->addDays(rand(1, 90));
            $bookingDate = $eventDate->copy()->subDays(rand(1, 30));

            Booking::create([
                'user_id' => $user->id,
                'event_package_id' => $package->id,
                'booking_date' => $bookingDate,
                'event_date' => $eventDate,
                'event_end_date' => $eventDate->copy()->addHours($package->duration),
                'guest_count' => rand(10, 200),
                'location' => $locations[array_rand($locations)],
                'special_requests' => $specialRequests[array_rand($specialRequests)],
                'status' => $statuses[array_rand($statuses)],
                'total_price' => $package->price * $this->calculateGuestMultiplier(rand(10, 200)),
            ]);
        }

        $this->command->info('Successfully seeded 50 bookings with related data!');
    }

    /**
     * Calculate price multiplier based on guest count
     */
    private function calculateGuestMultiplier($guestCount): float
    {
        if ($guestCount < 20) return 1.0;
        if ($guestCount < 50) return 0.9;
        if ($guestCount < 100) return 0.85;
        return 0.8; // Discount for large groups
    }
}