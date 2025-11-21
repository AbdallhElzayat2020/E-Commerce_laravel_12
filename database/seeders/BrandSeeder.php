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
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Google', 'ar' => 'جوجل'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Xiaomi', 'ar' => 'شاومي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'OnePlus', 'ar' => 'وان بلس'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Oppo', 'ar' => 'أوبو'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Vivo', 'ar' => 'فيفو'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Realme', 'ar' => 'ريال ميل'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Samsung', 'ar' => 'سامسونج'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Huawei', 'ar' => 'هواوي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Sony', 'ar' => 'سوني'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Nokia', 'ar' => 'نوكيا'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Lenovo', 'ar' => 'لينوفو'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'LG', 'ar' => 'إل جي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Asus', 'ar' => 'أسوس'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Dell', 'ar' => 'ديل'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'HP', 'ar' => 'إتش بي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Acer', 'ar' => 'أيسر'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Microsoft', 'ar' => 'مايكروسوفت'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Intel', 'ar' => 'إنتل'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'AMD', 'ar' => 'إيه إم دي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Nike', 'ar' => 'نايكي'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Adidas', 'ar' => 'أديداس'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Puma', 'ar' => 'بوما'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Reebok', 'ar' => 'ريبوك'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'Zara', 'ar' => 'زارا'],
                'logo' => 'logo.webp',
            ],
            [
                'name' => ['en' => 'H&M', 'ar' => 'إتش أند إم'],
                'logo' => 'logo.webp',
            ],
        ];

        foreach ($data as $key => $value) {
            Brand::create($value);
        }
    }
}
