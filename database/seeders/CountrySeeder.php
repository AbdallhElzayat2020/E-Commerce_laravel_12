<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => 1, 'name' => ['en' => 'Egypt', 'ar' => 'مصر'], 'phone_code' => '20', 'flag_code' => 'eg'],
            ['id' => 2, 'name' => ['en' => 'Saudi Arabia', 'ar' => 'المملكة العربية السعودية'], 'phone_code' => '966', 'flag_code' => 'sa'],
            ['id' => 3, 'name' => ['en' => 'United Arab Emirates', 'ar' => 'الإمارات العربية المتحدة'], 'phone_code' => '971', 'flag_code' => 'ae'],
            ['id' => 4, 'name' => ['en' => 'Kuwait', 'ar' => 'الكويت'], 'phone_code' => '965', 'flag_code' => 'kw'],
            ['id' => 5, 'name' => ['en' => 'Qatar', 'ar' => 'قطر'], 'phone_code' => '974', 'flag_code' => 'qa'],
            ['id' => 6, 'name' => ['en' => 'Bahrain', 'ar' => 'البحرين'], 'phone_code' => '973', 'flag_code' => 'bh'],
            ['id' => 7, 'name' => ['en' => 'Oman', 'ar' => 'عمان'], 'phone_code' => '968', 'flag_code' => 'om'],
            ['id' => 8, 'name' => ['en' => 'Jordan', 'ar' => 'الأردن'], 'phone_code' => '962', 'flag_code' => 'jo'],
            ['id' => 9, 'name' => ['en' => 'Iraq', 'ar' => 'العراق'], 'phone_code' => '964', 'flag_code' => 'iq'],
            ['id' => 10, 'name' => ['en' => 'Syria', 'ar' => 'سوريا'], 'phone_code' => '963', 'flag_code' => 'sy'],
            ['id' => 11, 'name' => ['en' => 'Lebanon', 'ar' => 'لبنان'], 'phone_code' => '961', 'flag_code' => 'lb'],
            ['id' => 12, 'name' => ['en' => 'Palestine', 'ar' => 'فلسطين'], 'phone_code' => '970', 'flag_code' => 'ps'],
            ['id' => 13, 'name' => ['en' => 'Yemen', 'ar' => 'اليمن'], 'phone_code' => '967', 'flag_code' => 'ye'],
            ['id' => 14, 'name' => ['en' => 'Sudan', 'ar' => 'السودان'], 'phone_code' => '249', 'flag_code' => 'sd'],
            ['id' => 15, 'name' => ['en' => 'Libya', 'ar' => 'ليبيا'], 'phone_code' => '218', 'flag_code' => 'ly'],
            ['id' => 16, 'name' => ['en' => 'Morocco', 'ar' => 'المغرب'], 'phone_code' => '212', 'flag_code' => 'ma'],
            ['id' => 17, 'name' => ['en' => 'Algeria', 'ar' => 'الجزائر'], 'phone_code' => '213', 'flag_code' => 'dz'],
            ['id' => 18, 'name' => ['en' => 'Tunisia', 'ar' => 'تونس'], 'phone_code' => '216', 'flag_code' => 'tn'],
            ['id' => 19, 'name' => ['en' => 'Mauritania', 'ar' => 'موريتانيا'], 'phone_code' => '222', 'flag_code' => 'mr'],
            ['id' => 20, 'name' => ['en' => 'Somalia', 'ar' => 'الصومال'], 'phone_code' => '252', 'flag_code' => 'so'],
            ['id' => 21, 'name' => ['en' => 'Djibouti', 'ar' => 'جيبوتي'], 'phone_code' => '253', 'flag_code' => 'dj'],
            ['id' => 22, 'name' => ['en' => 'Comoros', 'ar' => 'جزر القمر'], 'phone_code' => '269', 'flag_code' => 'km'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['id' => $country['id']],
                $country
            );
        }
    }
}
