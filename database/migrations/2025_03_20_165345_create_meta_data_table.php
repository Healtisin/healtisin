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
        Schema::create('meta_data', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default values
        DB::table('meta_data')->insert([
            ['key' => 'title', 'value' => 'Healtisin - Platform Kesehatan Terpercaya', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'description', 'value' => 'Healtisin adalah platform kesehatan terpercaya yang menyediakan layanan konsultasi medis online dan informasi kesehatan terkini.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'keywords', 'value' => 'kesehatan, konsultasi medis, dokter online, layanan kesehatan, informasi medis', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'charset', 'value' => 'UTF-8', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'author', 'value' => 'Healtisin Team', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'viewport', 'value' => 'width=device-width, initial-scale=1.0', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'robots', 'value' => 'index, follow', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_data');
    }
};
