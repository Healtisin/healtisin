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
        Schema::table('information', function (Blueprint $table) {
            if (!Schema::hasColumn('information', 'website_name')) {
                $table->string('website_name')->default('Healtisin');
            }
            
            if (!Schema::hasColumn('information', 'product_name')) {
                $table->string('product_name')->default('Healtisin AI');
            }
            
            if (!Schema::hasColumn('information', 'website_description')) {
                $table->text('website_description')->nullable();
            }
            
            if (!Schema::hasColumn('information', 'product_description')) {
                $table->text('product_description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn(['website_name', 'product_name', 'website_description', 'product_description']);
        });
    }
};
