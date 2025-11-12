<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => [
                'en' => 'Terms & Conditions',
                'ar' => 'الشروط والمصطلحات',
            ],
            'content' => [
                'ar' => 'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
                'en' => 'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
            ],
            'slug' => 'terms-Conditions'
        ]);
        Page::create([
            'title' => [
                'en' => 'Privacy Policy',
                'ar' => 'سياسة الخصوصية',
            ],
            'content' => [
                'ar' => 'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
                'en' => 'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
            ],
            'slug' => 'privacy-policy'

        ]);
    }
}
