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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('image');
            $table->string('position');
            $table->string('phone');
            $table->bigInteger('star'); 
            $table->text('description');
            $table->tinyInteger('status')->default(1);    // 1 = active, 0 = inactive
            $table->tinyInteger('verified')->default(0);  // 0 = unverified, 1 = verified
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
