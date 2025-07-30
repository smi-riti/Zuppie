<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Setting;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;

class TestBookingEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:booking-email {--booking-id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test booking confirmation email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookingId = $this->option('booking-id');
        
        if (!$bookingId) {
            $this->error('Please provide a booking ID using --booking-id option');
            return;
        }

        $booking = Booking::with(['eventPackage', 'user'])->find($bookingId);
        
        if (!$booking) {
            $this->error('Booking not found with ID: ' . $bookingId);
            return;
        }

        $this->info('Testing email for booking ID: ' . $bookingId);
        $this->info('Customer: ' . $booking->booking_name);
        $this->info('Package: ' . $booking->eventPackage->name);
        $this->info('User ID: ' . $booking->user_id);

        try {
            // Test user email using user_id from booking
            $bookingUser = $booking->user;
            if ($bookingUser && $bookingUser->email) {
                $this->info('Sending user confirmation email to: ' . $bookingUser->email . ' (User ID: ' . $bookingUser->id . ')');
                Mail::to($bookingUser->email)->send(new BookingConfirmationMail($booking, false));
                $this->info('✅ User email sent successfully');
            } else {
                $this->warn('No email found for user ID: ' . $booking->user_id);
            }

            // Test admin emails to all users where is_admin = 1
            $adminUsers = \App\Models\User::where('is_admin', 1)->get();
            if ($adminUsers->count() > 0) {
                $this->info('Found ' . $adminUsers->count() . ' admin user(s)');
                foreach ($adminUsers as $admin) {
                    if ($admin->email) {
                        $this->info('Sending admin notification email to: ' . $admin->email . ' (Admin ID: ' . $admin->id . ')');
                        Mail::to($admin->email)->send(new BookingConfirmationMail($booking, true));
                        $this->info('✅ Admin email sent to ' . $admin->name);
                    } else {
                        $this->warn('Admin user ' . $admin->name . ' (ID: ' . $admin->id . ') has no email address');
                    }
                }
            } else {
                $this->warn('No admin users found with is_admin = 1');
            }

        } catch (\Exception $e) {
            $this->error('❌ Email sending failed: ' . $e->getMessage());
        }
    }
}
