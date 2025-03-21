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
        Schema::create('pricing_configs', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->default('Pro');
            $table->decimal('monthly_price', 10, 2);
            $table->integer('duration_3_months_discount')->default(10); // dalam persen
            $table->integer('duration_6_months_discount')->default(15); // dalam persen
            $table->integer('duration_12_months_discount')->default(25); // dalam persen
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_configs');
    }
};
