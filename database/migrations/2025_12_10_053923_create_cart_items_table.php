<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
$table->foreignId('cart_id')->constrained('carts');
$table->foreignId('product_id')->constrained('products');
$table->foreignId('product_variant_id')->constrained('product_variants');
$table->integer('quantity');
$table->decimal('price');
$table->json('attributes');
$table->timestamps();//
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
