<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_package_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('offer_code')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('discount_type', ['flat', 'percent']);
            $table->decimal('discount_value', 10, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
