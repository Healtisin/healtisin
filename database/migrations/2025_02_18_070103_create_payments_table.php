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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->integer('duration');
            $table->string('payment_method');
            $table->enum('status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->timestamp('expired_at')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('snap_token')->nullable(); // Snap Token dari Midtrans
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
