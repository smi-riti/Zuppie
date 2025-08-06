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
        // Add new OTP columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp', 6)->nullable()->after('phone_no');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
        });

        // Standardize existing phone numbers
        DB::statement("UPDATE users SET phone_no = REGEXP_REPLACE(phone_no, '[^0-9]', '')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove OTP columns
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['otp', 'otp_expires_at']);
        });

        // Note: Phone number standardization cannot be reversed
        // We'll log a warning about this
        logger()->warning('Phone number standardization migration was reversed - numbers remain standardized');
    }


};
