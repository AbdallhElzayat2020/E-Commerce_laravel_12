<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('categories')->delete();
        $categories = [
            [
                'name' => ['ar' => 'الكترونيات', 'en' => 'Electronics'],
                'status' => 'active',
                'parent_id' => null,
                'description' => 'الكترونيات',
                'icon' => 'avatar.webp',
            ],
            [
                'name' => ['ar' => 'الملابس', 'en' => 'Clothes'],
                'status' => 'active',
                'parent_id' => null,
                'description' => 'الملابس',
                'parent_id' => null,
                'icon' => 'avatar.webp',
            ],
            [
                'name' => ['ar' => 'الأثاث', 'en' => 'Furniture'],
                'status' => 'active',
                'parent_id' => null,
                'description' => 'الأثاث',
                'icon' => 'avatar.webp',
            ],
            [
                'name' => ['ar' => 'الأدوات المنزلية', 'en' => 'Home Appliances'],
                'status' => 'active',
                'parent_id' => null,
                'description' => 'الأدوات المنزلية',
                'icon' => 'avatar.webp',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']['en']],
                $category
            );
        }
    }
}
