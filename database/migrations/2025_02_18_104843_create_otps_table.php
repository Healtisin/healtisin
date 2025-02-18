<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('otp', 6);
            $table->string('type'); // 'email_verification' atau 'password_reset'
            $table->timestamps();
            $table->index(['email', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
    }
};