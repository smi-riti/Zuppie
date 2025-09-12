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
        Schema::create('enquiry_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained()->onDelete('cascade');
            $table->string('image_url')->nullable();
            $table->string('image_file_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_images');
    }
};
