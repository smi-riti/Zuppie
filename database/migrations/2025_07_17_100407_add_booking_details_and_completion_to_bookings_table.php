<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_name')->nullable()->after('user_id');
            $table->string('booking_email')->nullable()->after('booking_name');
            $table->string('booking_phone_no')->nullable()->after('booking_email');
            $table->boolean('is_completed')->default(false)->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['booking_name', 'booking_email', 'booking_phone_no', 'is_completed']);
        });
    }
};
