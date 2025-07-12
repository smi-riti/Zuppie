<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
        public function run()
    {
        // Clear existing bookings (optional)
        // Booking::truncate();

        // Get or create necessary related models
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(5)->create();
        }

        $eventPackages = EventPackage::all();
        if ($eventPackages->isEmpty()) {
            foreach ($categories as $category) {
                EventPackage::factory()->count(3)->create([
                    'category_id' => $category->id,
                    'price' => rand(1000, 5000),
                ]);
            }
            $eventPackages = EventPackage::all();
        }

        $users = User::where('is_admin', false)->get();
        if ($users->isEmpty()) {
            $users = User::factory()->count(10)->create([
                'is_admin' => false,
                'password' => Hash::make('password'),
            ]);
        }

        // Status options
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        // Create bookings
        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $package = $eventPackages->random();
            
            $eventDate = Carbon::now()->addDays(rand(1, 90));
            $bookingDate = $eventDate->copy()->subDays(rand(1, 30));

            Booking::create([
                'user_id' => $user->id,
                'category_id' => $package->category_id,
                'event_package_id' => $package->id,
                'booking_date' => $bookingDate,
                'event_date' => $eventDate,
                'event_end_date' => $eventDate->copy()->addHours(rand(2, 8)),
                'guest_count' => rand(10, 200),
                'location' => $this->generateRandomLocation(),
                'special_requests' => rand(0, 1) ? $this->generateRandomRequest() : null,
                'status' => $statuses[array_rand($statuses)],
                'total_price' => $package->price * rand(5, 20),
            ]);
        }
    }

    private function generateRandomLocation(): string
    {
        $locations = [
            'Grand Ballroom, Hotel Taj',
            'Convention Center, Downtown',
            'Beachside Resort, Malibu',
            'Garden Pavilion, Central Park',
            'Rooftop Terrace, City View Hotel',
            'Grand Hall, Convention Plaza',
            'Lakeside Venue, Serene Waters',
            'Mountain View Lodge',
            'Historic Mansion, Old Town',
            'Modern Loft, Arts District'
        ];

        return $locations[array_rand($locations)];
    }

    private function generateRandomRequest(): string
    {
        $requests = [
            'Please ensure vegetarian meal options are available',
            'Need wheelchair accessibility for some guests',
            'Prefer minimal decoration with white and gold theme',
            'Require AV equipment for presentations',
            'Special cake to be served at midnight',
            'Need separate kids entertainment area',
            'Halal food options required',
            'Outdoor seating preferred if weather permits',
            'Live band requested for entertainment',
            'Special lighting effects for entrance'
        ];

        return $requests[array_rand($requests)];
    }
}