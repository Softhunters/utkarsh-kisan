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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('ptype')->unique();
            $table->string('pname')->unique();
            $table->string('pslug')->unique();
            $table->string('price')->unique();
            $table->string('validity');
            $table->date('up_to_date')->nullable();
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->integer('count', 11)->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
