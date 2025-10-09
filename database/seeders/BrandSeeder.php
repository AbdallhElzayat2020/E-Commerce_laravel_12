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
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
            ],
            [
                'name' => ['en' => 'Google', 'ar' => 'جوجل'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
            ],
            [
                'name' => ['en' => 'Xiaomi', 'ar' => 'شاومي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Xiaomi_logo.svg',
            ],
            [
                'name' => ['en' => 'OnePlus', 'ar' => 'وان بلس'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/OnePlus_logo.svg',
            ],
            [
                'name' => ['en' => 'Oppo', 'ar' => 'أوبو'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5b/OPPO_LOGO_2019.svg',
            ],
            [
                'name' => ['en' => 'Vivo', 'ar' => 'فيفو'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6b/Vivo_logo_2019.svg',
            ],
            [
                'name' => ['en' => 'Realme', 'ar' => 'ريال ميل'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6c/Realme_logo.svg',
            ],
            [
                'name' => ['en' => 'Samsung', 'ar' => 'سامسونج'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg',
            ],
            [
                'name' => ['en' => 'Huawei', 'ar' => 'هواوي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/00/Huawei_Standard_logo.svg',
            ],
            [
                'name' => ['en' => 'Sony', 'ar' => 'سوني'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/20/Sony_wordmark.svg',
            ],
            [
                'name' => ['en' => 'Nokia', 'ar' => 'نوكيا'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/7/7a/Nokia_wordmark.svg',
            ],
            [
                'name' => ['en' => 'Lenovo', 'ar' => 'لينوفو'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Lenovo_Global_Corporate_Logo.png',
            ],
            [
                'name' => ['en' => 'LG', 'ar' => 'إل جي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/LG_logo_%282015%29.svg',
            ],
            [
                'name' => ['en' => 'Asus', 'ar' => 'أسوس'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/ASUS_Logo.svg',
            ],
            [
                'name' => ['en' => 'Dell', 'ar' => 'ديل'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/48/Dell_Logo.svg',
            ],
            [
                'name' => ['en' => 'HP', 'ar' => 'إتش بي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/HP_logo_2012.svg',
            ],
            [
                'name' => ['en' => 'Acer', 'ar' => 'أيسر'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6a/Acer_2011.svg',
            ],
            [
                'name' => ['en' => 'Microsoft', 'ar' => 'مايكروسوفت'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
            ],
            [
                'name' => ['en' => 'Intel', 'ar' => 'إنتل'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c9/Intel-logo.svg',
            ],
            [
                'name' => ['en' => 'AMD', 'ar' => 'إيه إم دي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6f/AMD_Logo.svg',
            ],
            [
                'name' => ['en' => 'Nike', 'ar' => 'نايكي'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg',
            ],
            [
                'name' => ['en' => 'Adidas', 'ar' => 'أديداس'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg',
            ],
            [
                'name' => ['en' => 'Puma', 'ar' => 'بوما'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Puma_logo.svg',
            ],
            [
                'name' => ['en' => 'Reebok', 'ar' => 'ريبوك'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Reebok_2019_logo.svg',
            ],
            [
                'name' => ['en' => 'Zara', 'ar' => 'زارا'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/Zara_Logo.svg',
            ],
            [
                'name' => ['en' => 'H&M', 'ar' => 'إتش أند إم'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/53/H%26M-Logo.svg',
            ],
        ];

        foreach ($data as $key => $value) {
            Brand::create($value);
        }
    }
}
