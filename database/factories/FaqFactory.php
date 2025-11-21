<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'question' => [
                'en' => $this->faker->sentence(5) . '?',
                'ar' => $this->faker->sentence(5) . "?",
            ],
            'answer' => [
                'en' => $this->faker->paragraph(5) . '.',
                'ar' => $this->faker->paragraph(5) . '.',
            ],
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];
    }
}
