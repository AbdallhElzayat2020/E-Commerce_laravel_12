<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Brand::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $data = [
            [
                'name' => ['en' => 'Apple', 'ar' => 'ابل'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Google', 'ar' => 'جوجل'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Xiaomi', 'ar' => 'شاومي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'OnePlus', 'ar' => 'وان بلس'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Oppo', 'ar' => 'أوبو'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Vivo', 'ar' => 'فيفو'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Realme', 'ar' => 'ريال ميل'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Samsung', 'ar' => 'سامسونج'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Huawei', 'ar' => 'هواوي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Sony', 'ar' => 'سوني'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Nokia', 'ar' => 'نوكيا'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Lenovo', 'ar' => 'لينوفو'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'LG', 'ar' => 'إل جي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Asus', 'ar' => 'أسوس'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Dell', 'ar' => 'ديل'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'HP', 'ar' => 'إتش بي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Acer', 'ar' => 'أيسر'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Microsoft', 'ar' => 'مايكروسوفت'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Intel', 'ar' => 'إنتل'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'AMD', 'ar' => 'إيه إم دي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Nike', 'ar' => 'نايكي'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Adidas', 'ar' => 'أديداس'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Puma', 'ar' => 'بوما'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Reebok', 'ar' => 'ريبوك'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'Zara', 'ar' => 'زارا'],
                'logo' => 'logo.png',
            ],
            [
                'name' => ['en' => 'H&M', 'ar' => 'إتش أند إم'],
                'logo' => 'logo.png',
            ],
        ];

        foreach ($data as $key => $value) {
            Brand::create($value);
        }
    }
}
