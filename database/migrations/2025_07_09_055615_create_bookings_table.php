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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_package_id')->constrained()->onDelete('cascade');
            $table->dateTime('booking_date');
            $table->dateTime('event_date');
            $table->dateTime('event_end_date')->nullable();
            $table->integer('guest_count');
            $table->string('location');
            $table->text('special_requests')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('total_price', 8, 2);
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('setup_requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
