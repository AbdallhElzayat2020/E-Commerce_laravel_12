<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::truncate();

        for ($i = 1; $i <= 4; $i++) {
            Slider::create([
                'file_name' => 'slider' . $i . '.',
                'note' => [
                    'ar' => 'عنوان عربي لملاحظة السلايدر',
                    'en' => 'Title Arabic here for Slider Note'
                ],
            ]);
        }
    }
}
