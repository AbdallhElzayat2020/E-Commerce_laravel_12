<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'small_desc' => $this->faker->word(),
            'desc' => $this->faker->word(),
            'status' => $this->faker->word(),
            'sku' => $this->faker->word(),
            'available_for' => Carbon::now(),
            'views' => $this->faker->randomNumber(),
            'has_variant' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(),
            'has_discount' => $this->faker->boolean(),
            'discount' => $this->faker->randomFloat(),
            'start_discount' => Carbon::now(),
            'end_discount' => Carbon::now(),
            'manage_stock' => $this->faker->boolean(),
            'quantity' => $this->faker->randomNumber(),
            'available_in_stock' => $this->faker->randomNumber(),
            'brand_id' => $this->faker->randomNumber(),
            'category_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'description' => $this->faker->text(),
            'small_description' => $this->faker->text(),
            'slug' => $this->faker->slug(),
        ];
    }
}
