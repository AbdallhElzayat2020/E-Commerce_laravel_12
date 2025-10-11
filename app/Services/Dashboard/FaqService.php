<?php

namespace App\Services\Dashboard;

use App\Models\Faq;
use App\Repositories\Dashboard\FaqRepository;

class FaqService
{

    public FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getFaqs()
    {
        return $this->faqRepository->getFaqs();
    }

    public function getFaqById($id)
    {
        $faq = $this->faqRepository->getFaqById($id);
        if (!$faq) {
            abort(404);
        }
        return $faq;
    }

    public function createFaq($data)
    {
        return $this->faqRepository->createFaq($data);
    }

    public function updateFaq($id, $data)
    {
        $faq = $this->faqRepository->getFaqById($id);
        if (!$faq) {
            abort(404);
        }
        return $this->faqRepository->updateFaq($faq, $data);
    }

    public function deleteFaq($id)
    {
        $faq = $this->faqRepository->getFaqById($id);
        if (!$faq) {
            abort(404);
        }
        return $this->faqRepository->deleteFaq($faq);
    }
}
