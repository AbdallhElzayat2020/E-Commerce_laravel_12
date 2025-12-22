<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed the products table with sample products and images.
     *
     * - Reads all image files from public/uploads/products
     * - Creates one product for each image
     * - Links the image via product_images table
     */
    public function run(): void
    {
        $imagesPath = public_path('uploads/products');

        if (!File::exists($imagesPath)) {
            $this->command?->warn("Folder {$imagesPath} does not exist. Skipping ProductSeeder.");
            return;
        }

        $files = collect(File::files($imagesPath))
            ->filter(function ($file) {
                return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
            })
            ->values();

        if ($files->isEmpty()) {
            $this->command?->warn("No image files found in {$imagesPath}. Put some images there and re-run the seeder.");
            return;
        }

        $defaultBrand = Brand::first();
        $defaultCategory = Category::first();

        if (!$defaultBrand || !$defaultCategory) {
            $this->command?->warn('Brand or Category not found. Make sure BrandSeeder and CategorySeeder have been run before ProductSeeder.');
            return;
        }

        foreach ($files as $index => $file) {
            $fileName = $file->getFilename();
            $baseName = pathinfo($fileName, PATHINFO_FILENAME);

            $productNameEn = Str::headline($baseName);
            $productNameAr = 'منتج ' . ($index + 1);

            $product = Product::create([
                'name' => [
                    'en' => $productNameEn,
                    'ar' => $productNameAr,
                ],
                'small_desc' => [
                    'en' => 'Sample short description for ' . $productNameEn,
                    'ar' => 'وصف قصير تجريبي لـ ' . $productNameAr,
                ],
                'desc' => [
                    'en' => 'Sample long description for ' . $productNameEn,
                    'ar' => 'وصف طويل تجريبي لـ ' . $productNameAr,
                ],
                'status' => 'active',
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'available_for' => now()->toDateString(),
                'views' => 0,
                'has_variants' => 0,
                'price' => rand(500, 5000),
                'has_discount' => rand(0, 1),
                'discount' => rand(0, 1) ? rand(50, 300) : 0,
                'start_discount' => now()->subDays(rand(0, 5))->toDateString(),
                'end_discount' => now()->addDays(rand(5, 15))->toDateString(),
                'manage_stock' => 1,
                'quantity' => rand(5, 50),
                'available_in_stock' => 1,
                'brand_id' => $defaultBrand->id,
                'category_id' => $defaultCategory->id,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'file_name' => $fileName,
                'file_size' => $file->getSize(),
                'file_type' => $file->getExtension(),
            ]);
        }

        $this->command?->info('Products and images seeded successfully from public/uploads/products.');
    }
}
