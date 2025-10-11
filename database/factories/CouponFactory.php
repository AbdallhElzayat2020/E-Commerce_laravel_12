<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Coupon::class;

    public function definition(): array
    {
        $limit = $this->faker->numberBetween(10, 100);
        $time_used = $this->faker->numberBetween(0, $limit);

        return [
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'discount_percentage' => $this->faker->numberBetween(10, 50),
            'status' => $this->faker->randomElement(['active', 'inactive']),

            'start_date' => now()->addDays(random_int(1, 4)),
            'end_date' => now()->addDays(random_int(5, 30)),

            'limit' => $limit,
            'time_used' => $time_used,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
