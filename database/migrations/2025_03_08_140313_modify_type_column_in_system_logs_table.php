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
        Schema::table('system_logs', function (Blueprint $table) {
            // Drop kolom type yang lama
            $table->dropColumn('type');
        });

        Schema::table('system_logs', function (Blueprint $table) {
            // Buat ulang kolom type dengan enum
            $table->enum('type', ['error', 'warning', 'info', 'audit_success', 'audit_failure'])
                  ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            // Drop kolom type yang baru
            $table->dropColumn('type');
        });

        Schema::table('system_logs', function (Blueprint $table) {
            // Kembalikan ke kolom type yang lama
            $table->string('type')->after('id');
        });
    }
};
