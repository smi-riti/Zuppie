<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('event_packages', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->text('features')->nullable()->after('description');
        });

        // Generate slugs for existing records
        DB::statement('UPDATE event_packages SET slug = LOWER(REPLACE(name, " ", "-")) WHERE slug IS NULL');
        
        // Make slug unique after populating
        Schema::table('event_packages', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_packages', function (Blueprint $table) {
            $table->dropColumn(['slug', 'features']);
        });
    }
};