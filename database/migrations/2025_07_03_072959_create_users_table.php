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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 12)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('profile')->nullable();
            $table->string('utype')->default('USR')->comment('ADM for admin and USR for User');
            $table->tinyInteger('status')->default(1)->comment('ADM for admin and USR for User');
            $table->tinyInteger('is_active')->default(1)->comment('1 for active and 0 for not active');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('device_token')->nullable();
            $table->string('referral_code', 6)->nullable();
            $table->string('referral_by', 6)->nullable();
            $table->integer('otp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
