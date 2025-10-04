<?php

namespace Database\Seeders;

use App\Models\Governorate;
use App\Models\ShippingGovernorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //        DB::table('governorates')->truncate();

        $governorates = [
            // ======== Start: Egypt Governorates ========
            ['name' => ['en' => 'Cairo', 'ar' => 'القاهرة'], 'country_id' => 1],
            ['name' => ['en' => 'Giza', 'ar' => 'الجيزة'], 'country_id' => 1],
            ['name' => ['en' => 'Alexandria', 'ar' => 'الإسكندرية'], 'country_id' => 1],
            ['name' => ['en' => 'Dakahlia', 'ar' => 'الدقهلية'], 'country_id' => 1],
            ['name' => ['en' => 'Red Sea', 'ar' => 'البحر الأحمر'], 'country_id' => 1],
            ['name' => ['en' => 'Beheira', 'ar' => 'البحيرة'], 'country_id' => 1],
            ['name' => ['en' => 'Fayoum', 'ar' => 'الفيوم'], 'country_id' => 1],
            ['name' => ['en' => 'Gharbia', 'ar' => 'الغربية'], 'country_id' => 1],
            ['name' => ['en' => 'Ismailia', 'ar' => 'الإسماعيلية'], 'country_id' => 1],
            ['name' => ['en' => 'Menofia', 'ar' => 'المنوفية'], 'country_id' => 1],
            ['name' => ['en' => 'Minya', 'ar' => 'المنيا'], 'country_id' => 1],
            ['name' => ['en' => 'Qaliubiya', 'ar' => 'القليوبية'], 'country_id' => 1],
            ['name' => ['en' => 'New Valley', 'ar' => 'الوادي الجديد'], 'country_id' => 1],
            ['name' => ['en' => 'Suez', 'ar' => 'السويس'], 'country_id' => 1],
            ['name' => ['en' => 'Aswan', 'ar' => 'أسوان'], 'country_id' => 1],
            ['name' => ['en' => 'Assiut', 'ar' => 'أسيوط'], 'country_id' => 1],
            ['name' => ['en' => 'Beni Suef', 'ar' => 'بني سويف'], 'country_id' => 1],
            ['name' => ['en' => 'Port Said', 'ar' => 'بورسعيد'], 'country_id' => 1],
            ['name' => ['en' => 'Damietta', 'ar' => 'دمياط'], 'country_id' => 1],
            ['name' => ['en' => 'Sharkia', 'ar' => 'الشرقية'], 'country_id' => 1],
            ['name' => ['en' => 'South Sinai', 'ar' => 'جنوب سيناء'], 'country_id' => 1],
            ['name' => ['en' => 'North Sinai', 'ar' => 'شمال سيناء'], 'country_id' => 1],
            ['name' => ['en' => 'Kafr El Sheikh', 'ar' => 'كفر الشيخ'], 'country_id' => 1],
            ['name' => ['en' => 'Matrouh', 'ar' => 'مطروح'], 'country_id' => 1],
            ['name' => ['en' => 'Luxor', 'ar' => 'الأقصر'], 'country_id' => 1],
            ['name' => ['en' => 'Qena', 'ar' => 'قنا'], 'country_id' => 1],
            ['name' => ['en' => 'Sohag', 'ar' => 'سوهاج'], 'country_id' => 1],
            // ======== End: Egypt Governorates ========

            // ======== Start: Saudi Arabia Regions ========
            ['name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 'country_id' => 2],
            ['name' => ['en' => 'Makkah', 'ar' => 'مكة المكرمة'], 'country_id' => 2],
            ['name' => ['en' => 'Medina', 'ar' => 'المدينة المنورة'], 'country_id' => 2],
            ['name' => ['en' => 'Eastern Province', 'ar' => 'المنطقة الشرقية'], 'country_id' => 2],
            ['name' => ['en' => 'Asir', 'ar' => 'عسير'], 'country_id' => 2],
            ['name' => ['en' => 'Tabuk', 'ar' => 'تبوك'], 'country_id' => 2],
            ['name' => ['en' => 'Hail', 'ar' => 'حائل'], 'country_id' => 2],
            ['name' => ['en' => 'Jazan', 'ar' => 'جازان'], 'country_id' => 2],
            ['name' => ['en' => 'Najran', 'ar' => 'نجران'], 'country_id' => 2],
            ['name' => ['en' => 'Al Bahah', 'ar' => 'الباحة'], 'country_id' => 2],
            ['name' => ['en' => 'Al Jawf', 'ar' => 'الجوف'], 'country_id' => 2],
            ['name' => ['en' => 'Northern Borders', 'ar' => 'الحدود الشمالية'], 'country_id' => 2],
            // ======== End: Saudi Arabia Regions ========

            // ======== Start: United Arab Emirates Emirates ========
            ['name' => ['en' => 'Abu Dhabi', 'ar' => 'أبو ظبي'], 'country_id' => 3],
            ['name' => ['en' => 'Dubai', 'ar' => 'دبي'], 'country_id' => 3],
            ['name' => ['en' => 'Sharjah', 'ar' => 'الشارقة'], 'country_id' => 3],
            ['name' => ['en' => 'Ajman', 'ar' => 'عجمان'], 'country_id' => 3],
            ['name' => ['en' => 'Umm Al Quwain', 'ar' => 'أم القيوين'], 'country_id' => 3],
            ['name' => ['en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'], 'country_id' => 3],
            ['name' => ['en' => 'Fujairah', 'ar' => 'الفجيرة'], 'country_id' => 3],
            // ======== End: United Arab Emirates Emirates ========

            // ======== Start: Oman Governorates ========
            ['name' => ['en' => 'Muscat', 'ar' => 'مسقط'], 'country_id' => 4],
            ['name' => ['en' => 'Dhofar', 'ar' => 'ظفار'], 'country_id' => 4],
            ['name' => ['en' => 'Musandam', 'ar' => 'مسندم'], 'country_id' => 4],
            ['name' => ['en' => 'Al Buraimi', 'ar' => 'البريمي'], 'country_id' => 4],
            ['name' => ['en' => 'Ad Dakhiliyah', 'ar' => 'الداخلية'], 'country_id' => 4],
            ['name' => ['en' => 'Al Batinah North', 'ar' => 'شمال الباطنة'], 'country_id' => 4],
            ['name' => ['en' => 'Al Batinah South', 'ar' => 'جنوب الباطنة'], 'country_id' => 4],
            ['name' => ['en' => 'Ash Sharqiyah North', 'ar' => 'شمال الشرقية'], 'country_id' => 4],
            ['name' => ['en' => 'Ash Sharqiyah South', 'ar' => 'جنوب الشرقية'], 'country_id' => 4],
            ['name' => ['en' => 'Al Dhahirah', 'ar' => 'الظاهرة'], 'country_id' => 4],
            ['name' => ['en' => 'Al Wusta', 'ar' => 'الوسطى'], 'country_id' => 4],
            // ======== End: Oman Governorates ========

            //  // ======== Start: Sudan Governorates ========
            ['name' => ['en' => 'Khartoum', 'ar' => 'الخرطوم'], 'country_id' => 3],
            ['name' => ['en' => 'Gezira', 'ar' => 'الجزيرة'], 'country_id' => 3],
            ['name' => ['en' => 'River Nile', 'ar' => 'نهر النيل'], 'country_id' => 3],
            ['name' => ['en' => 'North Kordofan', 'ar' => 'شمال كردفان'], 'country_id' => 3],
            ['name' => ['en' => 'South Kordofan', 'ar' => 'جنوب كردفان'], 'country_id' => 3],
            ['name' => ['en' => 'North Darfur', 'ar' => 'شمال دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'South Darfur', 'ar' => 'جنوب دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'West Darfur', 'ar' => 'غرب دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'East Darfur', 'ar' => 'شرق دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'Central Darfur', 'ar' => 'وسط دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'Northern State', 'ar' => 'الولاية الشمالية'], 'country_id' => 3],
            ['name' => ['en' => 'White Nile', 'ar' => 'النيل الأبيض'], 'country_id' => 3],
            ['name' => ['en' => 'Blue Nile', 'ar' => 'النيل الأزرق'], 'country_id' => 3],
            ['name' => ['en' => 'Sennar', 'ar' => 'سنار'], 'country_id' => 3],
            ['name' => ['en' => 'Kassala', 'ar' => 'كسلا'], 'country_id' => 3],
            ['name' => ['en' => 'Gedaref', 'ar' => 'القضارف'], 'country_id' => 3],
            ['name' => ['en' => 'West Kordofan', 'ar' => 'غرب كردفان'], 'country_id' => 3],
            // ======== End: Sudan Governorates ========

            // ======== Start: Sudan Governorates ========
            ['name' => ['en' => 'Rabat-Salé-Kénitra', 'ar' => 'الرباط-سلا-القنيطرة'], 'country_id' => 5],
            ['name' => ['en' => 'Casablanca-Settat', 'ar' => 'الدار البيضاء-سطات'], 'country_id' => 5],
            ['name' => ['en' => 'Marrakech-Safi', 'ar' => 'مراكش-آسفي'], 'country_id' => 5],
            ['name' => ['en' => 'Fès-Meknès', 'ar' => 'فاس-مكناس'], 'country_id' => 5],
            ['name' => ['en' => 'Tanger-Tetouan-Al Hoceima', 'ar' => 'طنجة-تطوان-الحسيمة'], 'country_id' => 5],
            ['name' => ['en' => 'Oriental', 'ar' => 'الشرق'], 'country_id' => 5],
            ['name' => ['en' => 'Béni Mellal-Khénifra', 'ar' => 'بني ملال-خنيفرة'], 'country_id' => 5],
            ['name' => ['en' => 'Drâa-Tafilalet', 'ar' => 'درعة-تافيلالت'], 'country_id' => 5],
            ['name' => ['en' => 'Souss-Massa', 'ar' => 'سوس-ماسة'], 'country_id' => 5],
            ['name' => ['en' => 'Guelmim-Oued Noun', 'ar' => 'كلميم-واد نون'], 'country_id' => 5],
            ['name' => ['en' => 'Laâyoune-Sakia El Hamra', 'ar' => 'العيون-الساقية الحمراء'], 'country_id' => 5],
            ['name' => ['en' => 'Dakhla-Oued Ed-Dahab', 'ar' => 'الداخلة-وادي الذهب'], 'country_id' => 5],
            // ======== End: Sudan Governorates ========

        ];

        foreach ($governorates as $governorate) {
            $gov = Governorate::updateOrCreate(
                ['name' => $governorate['name'], 'country_id' => $governorate['country_id']],
                $governorate
            );

            // Create an associated shipping governorate
            ShippingGovernorate::updateOrCreate(
                ['governorate_id' => $gov->id],
                [
                    'governorate_id' => $gov->id,
                    'price' => (rand(100, 10000) / 100),
                ]
            );
        }
    }
}
