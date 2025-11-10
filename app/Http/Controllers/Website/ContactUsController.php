<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function showContactUsPage()
    {
        return view('frontend.pages.contact-us');
    }
}
