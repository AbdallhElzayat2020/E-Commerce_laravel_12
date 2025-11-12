<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    public function showDynamicPage($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if ($page) {
            return view('frontend.pages.dynamic-page', compact('page'));
        } else {
            abort(404);
        }
    }
}
