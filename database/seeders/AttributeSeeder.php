<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Attribute::truncate();
        AttributeValue::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // attribute
        $size_attribute = Attribute::create([
            'name' => [
                'en' => 'Size',
                'ar' => 'المقاس'
            ],
        ]);

        // attribute values
        $size_attribute->attributeValues()->createMany([
            [
                'value' => [
                    'en' => 'small',
                    'ar' => 'صغير',
                ],
            ],
            [
                'value' => [
                    'en' => 'medium',
                    'ar' => 'متوسط',
                ],
            ],
            [
                'value' => [
                    'en' => 'large',
                    'ar' => 'كبير',
                ],
            ]
        ]);

        // color attribute
        $color_attribute = Attribute::create([
            'name' => [
                'en' => 'Color',
                'ar' => 'اللون'
            ],
        ]);
        // attribute values
        $color_attribute->attributeValues()->createMany([
            [
                'value' => [
                    'en' => 'red',
                    'ar' => 'أحمر',
                ],
            ],
            [
                'value' => [
                    'en' => 'blue',
                    'ar' => 'أزرق',
                ],
            ],
            [
                'value' => [
                    'en' => 'green',
                    'ar' => 'أخضر',
                ],
            ]
        ]);
    }
}
