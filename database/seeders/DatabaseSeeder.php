<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            FaqSeeder::class,
            CouponSeeder::class,
            AttributeSeeder::class,
            UserSeeder::class,
            ContactSeeder::class,
            SliderSeeder::class,
            PageSeeder::class,
        ]);
    }
}
