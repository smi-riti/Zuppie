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
        Schema::table('payments', function (Blueprint $table) {
            // Razorpay specific fields
            $table->string('razorpay_payment_id')->nullable()->after('transaction_id');
            $table->string('razorpay_order_id')->nullable()->after('razorpay_payment_id');
            $table->string('razorpay_signature')->nullable()->after('razorpay_order_id');
            
            // Additional tracking fields
            $table->string('currency', 3)->default('INR')->after('amount');
            
            // Update status enum to include 'paid'
            $table->dropColumn('status');
        });
        
        // Add the new status column with updated enum values
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'paid', 'completed', 'failed', 'refunded'])->default('pending')->after('razorpay_signature');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'razorpay_payment_id',
                'razorpay_order_id', 
                'razorpay_signature',
                'currency'
            ]);
            
            // Restore original status enum
            $table->dropColumn('status');
        });
        
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
        });
    }
};
