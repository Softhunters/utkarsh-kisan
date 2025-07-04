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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('manufacturer_details')->nullable();
            $table->decimal('regular_price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->string('SKU')->nullable();
            $table->enum('stock_status', ['instock', 'outofstock'])->default('instock');
            $table->boolean('featured')->default(false);
            $table->integer('quantity')->nullable();
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->foreignId('subsubcategory_id')->nullable()->constrained('subsub_categories')->nullOnDelete();
            $table->timestamps();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('tags')->nullable();
            $table->boolean('is_baby')->default(false);
            $table->boolean('is_child')->default(false);
            $table->boolean('is_young')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('add_by')->nullable();
            $table->foreignId('tax_id')->nullable()->constrained()->nullOnDelete();
            $table->string('freecancellation')->nullable();
            $table->string('discount_value', 10)->nullable();
            $table->string('variant_detail')->nullable();
            $table->string('flavour_id')->nullable();
            $table->tinyInteger('size_limit')->nullable();
            $table->tinyInteger('age_limit')->nullable();
            $table->string('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('order_qty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
