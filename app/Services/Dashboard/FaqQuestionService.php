<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqQuestionRepository;
use Yajra\DataTables\Facades\DataTables;

class FaqQuestionService
{
    protected $faqQuestionRepository;

    public function __construct(FaqQuestionRepository $faqQuestionRepository)
    {
        $this->faqQuestionRepository = $faqQuestionRepository;
    }

    public function getFaqQuestionForDataTables()
    {
        $questions = $this->faqQuestionRepository->getFaqQuestions();
        return DataTables::of($questions)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                return view('dashboard.pages.faq-questions.datatables.action', compact('item'))->render();
            })
            ->addColumn('message', function ($item) {
                return view('dashboard.pages.faq-questions.datatables.content', compact('item'));
            })
            ->make(true);
    }

    public function getFaqQuestionById($id)
    {
        return $this->faqQuestionRepository->getFaqQuestionById($id);
    }

    public function deleteFaqQuestion($question)
    {
        return $this->faqQuestionRepository->deleteFaqQuestion($question);
    }
}
