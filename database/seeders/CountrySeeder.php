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
            ['id' => 1, 'name' => ['en' => 'Egypt', 'ar' => 'مصر'], 'phone_code' => '20'],
            ['id' => 2, 'name' => ['en' => 'Saudi Arabia', 'ar' => 'المملكة العربية السعودية'], 'phone_code' => '966'],
            ['id' => 3, 'name' => ['en' => 'United Arab Emirates', 'ar' => 'الإمارات العربية المتحدة'], 'phone_code' => '971'],
            ['id' => 4, 'name' => ['en' => 'Kuwait', 'ar' => 'الكويت'], 'phone_code' => '965'],
            ['id' => 5, 'name' => ['en' => 'Qatar', 'ar' => 'قطر'], 'phone_code' => '974'],
            ['id' => 6, 'name' => ['en' => 'Bahrain', 'ar' => 'البحرين'], 'phone_code' => '973'],
            ['id' => 7, 'name' => ['en' => 'Oman', 'ar' => 'عمان'], 'phone_code' => '968'],
            ['id' => 8, 'name' => ['en' => 'Jordan', 'ar' => 'الأردن'], 'phone_code' => '962'],
            ['id' => 9, 'name' => ['en' => 'Iraq', 'ar' => 'العراق'], 'phone_code' => '964'],
            ['id' => 10, 'name' => ['en' => 'Syria', 'ar' => 'سوريا'], 'phone_code' => '963'],
            ['id' => 11, 'name' => ['en' => 'Lebanon', 'ar' => 'لبنان'], 'phone_code' => '961'],
            ['id' => 12, 'name' => ['en' => 'Palestine', 'ar' => 'فلسطين'], 'phone_code' => '970'],
            ['id' => 13, 'name' => ['en' => 'Yemen', 'ar' => 'اليمن'], 'phone_code' => '967'],
            ['id' => 14, 'name' => ['en' => 'Sudan', 'ar' => 'السودان'], 'phone_code' => '249'],
            ['id' => 15, 'name' => ['en' => 'Libya', 'ar' => 'ليبيا'], 'phone_code' => '218'],
            ['id' => 16, 'name' => ['en' => 'Morocco', 'ar' => 'المغرب'], 'phone_code' => '212'],
            ['id' => 17, 'name' => ['en' => 'Algeria', 'ar' => 'الجزائر'], 'phone_code' => '213'],
            ['id' => 18, 'name' => ['en' => 'Tunisia', 'ar' => 'تونس'], 'phone_code' => '216'],
            ['id' => 19, 'name' => ['en' => 'Mauritania', 'ar' => 'موريتانيا'], 'phone_code' => '222'],
            ['id' => 20, 'name' => ['en' => 'Somalia', 'ar' => 'الصومال'], 'phone_code' => '252'],
            ['id' => 21, 'name' => ['en' => 'Djibouti', 'ar' => 'جيبوتي'], 'phone_code' => '253'],
            ['id' => 22, 'name' => ['en' => 'Comoros', 'ar' => 'جزر القمر'], 'phone_code' => '269'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['id' => $country['id']],
                $country
            );
        }
    }
}
