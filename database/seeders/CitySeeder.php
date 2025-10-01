<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('transactions')->delete();

        $cities = [
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'القاهرة', 'en' => 'Cairo'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'الجيزة', 'en' => 'Giza'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'الشرقية', 'en' => 'Sharqia'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'الدقهلية', 'en' => 'Dakahlia'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'الإسكندرية', 'en' => 'Alexandria'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'المنصورة', 'en' => 'Mansoura'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'المنيا', 'en' => 'Minya'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'أسيوط', 'en' => 'Assiut'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'سوهاج', 'en' => 'Sohag'],
            ],
            [
                'governorate_id' => 1,
                'name' => ['ar' => 'قنا', 'en' => 'Qena'],
            ],

        ];

        foreach ($cities as $index => $city) {
            City::updateOrCreate($city);
        }
    }
}
