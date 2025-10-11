<?php

namespace App\Repositories\Dashboard;

use App\Models\Faq;

class FaqRepository
{

    public function getFaqs()
    {
        return Faq::query()->latest()->get();
    }

    public function getFaqById($id)
    {
        return Faq::find($id);
    }

    public function createFaq($data)
    {
        return Faq::create($data);
    }

    public function updateFaq($faq, $data)
    {
        return $faq->update($data);
    }

    public function deleteFaq($faq)
    {
        return $faq->delete();
    }

}
