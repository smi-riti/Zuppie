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
        Schema::create('categories', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Can store image URL or path
            $table->string('image_file_id')->nullable(); // Optional, if using separate file table
            $table->boolean('is_special')->default(false);
            $table->unsignedBigInteger('parent_id')->nullable(); // Self-referencing for parent-child

            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
