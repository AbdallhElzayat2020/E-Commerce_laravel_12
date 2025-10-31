<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServicesProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        View::composer('dashboard.*', function ($view) {
            if (!Cache::has('categories_count')) {
                Cache::remember('categories_count', 60 * 60 * 24, function () {
                    return Category::count();
                });
            }

            if (!Cache::has('brands_count')) {
                Cache::remember('brands_count', 60 * 60 * 24, function () {
                    return Brand::count();
                });
            }

            if (!Cache::has('coupons_count')) {
                Cache::remember('coupons_count', 60 * 60 * 24, function () {
                    return Coupon::count();
                });
            }

            if (!Cache::has('admins_count')) {
                Cache::remember('admins_count', 60 * 60 * 24, function () {
                    return Admin::count();
                });
            }

            if (!Cache::has('faqs_count')) {
                Cache::remember('faqs_count', 60 * 60 * 24, function () {
                    return Faq::count();
                });
            }

            if (!Cache::has('contacts_count')) {
                Cache::remember('contacts_count', 60 * 60 * 24, function () {
                    return Contact::where('is_read', 0)->count();
                });
            }

        });

        view()->share([
            'categories_count' => Cache::get('categories_count'),
            'brands_count' => Cache::get('brands_count'),
            'coupons_count' => Cache::get('coupons_count'),
            'admins_count' => Cache::get('admins_count'),
            'faqs_count' => Cache::get('faqs_count'),
            'contacts_count' => Cache::get('contacts_count'),
        ]);

        // settings
        $settings = $this->firstOrCreateSetting();
        view()->share([
            'settings' => $settings,
        ]);

    }


    // create setting

    public function firstOrCreateSetting()
    {
        $getSetting = Setting::firstOr(function () {

            return Setting::create([
                'site_name' => [
                    'ar' => 'متجر الكتروني',
                    'en' => 'E-Commerce',
                ],
                'site_desc' => [
                    'en' => 'At [Your Brand Name], we believe that fashion is more than just clothing — its a way to express who you are. Founded in [Year], our mission has always been simple: to offer high-quality, stylish, and affordable clothing that makes you feel confident every day.From casual wear to statement pieces, every item in our collection is handpicked with care and crafted to suit modern lifestyles. Whether youre dressing up for a night out or keeping it comfy at home, we’ve got something just for you.What sets us apart?✅ Trend-forward designs✅ Premium quality fabrics✅ Affordable prices✅ Fast, reliable shipping✅ Friendly customer service that actually cares We’re more than just a store — we’re a community of fashion lovers who embrace individuality, confidence, and creativity. Thank you for choosing [Your Brand Name] to be a part of your style journey.',
                    'ar' => 'هذا موقع متجر الكتروني ',
                ],
                'site_address' => [
                    'en' => 'Egypt , Alex , Mandara',
                    'ar' => 'الغربية المحلة الكبري',
                ],
                'site_phone' => '01222220000',
                'site_email' => 'e-commerce@gmail.com',
                'email_support' => 'e-commerceSupport@gmail.com',

                // socail
                'facebook_url' => 'https://www.facebook.com/',
                'x_url' => 'https://www.twitter.com/',
                'youtube_url' => 'https://www.youtube.com/',

                'logo' => 'logo.png',
                'favicon' => 'logo.png',
                'site_copyright' => '©2025 Your E-commerce Name. All rights reserved.',

                'meta_description' => [
                    'en' => '23 of PARAGE is equality of condition, blood, or dignity; specifically',
                    'ar' => '23 of PARAGE is equality of condition, blood, or dignity; specifically ',
                ],
                'promotion_video_url' => 'https://www.youtube.com/embed/SsE5U7ta9Lw?rel=0&amp;controls=0&amp;showinfo=0',

            ]);
        });
        return $getSetting;
    }
}
