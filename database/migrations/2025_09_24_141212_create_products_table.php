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
            $table->string('small_desc')->nullable();
//            $table->string('slug')->unique();
            $table->longText('desc');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('sku');
            $table->date('available_for')->nullable();
            $table->integer('views')->default(0);


            $table->boolean('has_variant')->default(0);

            $table->decimal('price', 10, 3)->nullable();  // if has variant then price will be null
            $table->boolean('has_discount')->default(0); // if has variant then price will be null
            $table->decimal('discount', 10, 3)->nullable();
            $table->date('start_discount')->nullable();
            $table->date('end_discount')->nullable();

            $table->boolean('manage_stock')->default(0);
            $table->integer('quantity')->nullable(); // if has variant, then quantity will be null
            $table->integer('available_in_stock')->default(1);

            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->timestamps();
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
