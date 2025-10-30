<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected static ?string $password;


    public function definition(): array
    {

        $country = Country::inRandomOrder()->first();
        if (!$country) {
            throw new \Exception("No countries found! Please seed the countries table.");
        }

        $governorate = $country->governorates()->inRandomOrder()->first();
        if (!$governorate) {
            throw new \Exception("No governorates found for country {$country->id}! Please seed the governorates table.");
        }

        //        $city = $governorate->cities()->inRandomOrder()->first();
        //        if (!$city) {
        //            throw new \Exception("No cities found for governorate {$governorate->id}! Please seed the cities table.");
        //        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'status' => 'active',
            'country_id' => $country->id,
            'governorate_id' => $governorate->id,
            'city_id' => random_int(1, 4),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
