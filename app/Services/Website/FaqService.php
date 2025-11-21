<?php

namespace App\Services\Website;

use App\Models\Faq;
use App\Models\FaqQuestion;

class FaqService
{
    public function getFaqs()
    {
        return Faq::select('id', 'question', 'answer')->active()->get();
    }

    public function createFaqQuestion($data)
    {
        return FaqQuestion::create($data);
    }
}
