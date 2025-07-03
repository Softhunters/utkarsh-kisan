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
        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete();
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('country');
            $table->string('pin_code');
            $table->string('id_proof_type');
            $table->string('proof_image');
            $table->string('gstin_number')->nullable();
            $table->string('gstin_image')->nullable();
            $table->boolean('status')->default(0); // 0 = Not Verified, 1 = Verified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_profiles');
    }
};
