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
            $table->time('event_time')->nullable()->after('event_date');
            $table->enum('payment_method', ['cash', 'online'])->default('cash')->after('total_price');
            $table->decimal('advance_amount', 10, 2)->nullable()->after('payment_method');
            $table->boolean('advance_paid')->default(false)->after('advance_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['event_time', 'payment_method', 'advance_amount', 'advance_paid']);
        });
    }
};
