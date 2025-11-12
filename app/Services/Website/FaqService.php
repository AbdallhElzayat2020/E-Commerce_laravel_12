<?php

namespace App\Services\Website;

use App\Models\Faq;

class FaqService
{
    public function getFaqs()
    {
        return Faq::active()->get();
    }
}
