<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        return $this->faqService = $faqService;
    }

    public function showFaqPage()
    {
        $faqs = $this->faqService->getFaqs();
        if (!$faqs) {
            abort(404);
        }
        return view('frontend.pages.faq', compact('faqs'));
    }
}
