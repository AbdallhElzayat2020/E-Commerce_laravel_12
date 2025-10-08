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
        DB::table('categories')->delete();
        $categories = [
            [
                'name' => ['ar' => 'الكترونيات', 'en' => 'Electronics'],
                'status' => 'active',
                'description' => 'الكترونيات',
                'icon' => asset('assets/dashboard/images/avatar.jpg'),
            ],
            [
                'name' => ['ar' => 'الملابس', 'en' => 'Clothes'],
                'status' => 'active',
                'description' => 'الملابس',
                'icon' => asset('assets/dashboard/images/avatar.jpg'),
            ],
            [
                'name' => ['ar' => 'الأثاث', 'en' => 'Furniture'],
                'status' => 'active',
                'description' => 'الأثاث',
                'icon' => asset('assets/dashboard/images/avatar.jpg'),
            ],
            [
                'name' => ['ar' => 'الأدوات المنزلية', 'en' => 'Home Appliances'],
                'status' => 'active',
                'description' => 'الأدوات المنزلية',
                'icon' => asset('assets/dashboard/images/avatar.jpg'),
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
