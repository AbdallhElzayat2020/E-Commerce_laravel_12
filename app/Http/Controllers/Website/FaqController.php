<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Services\Website\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function showFaqPage()
    {
        $faqs = $this->faqService->getFaqs();
        Faq::paginate(15);
        if (!$faqs) {
            abort(404);
        }
        return view('frontend.pages.faq', compact('faqs'));
    }
}
