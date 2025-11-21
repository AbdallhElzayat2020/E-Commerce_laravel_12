<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\FaqQuestionService;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{

    protected $faqQuestionService;

    public function __construct(FaqQuestionService $faqQuestionService)
    {
        $this->faqQuestionService = $faqQuestionService;
    }


    public function getAll()
    {
        return $this->faqQuestionService->getFaqQuestionForDataTables();
    }

    public function index()
    {
        return view('dashboard.pages.faq-questions.index');
    }

    public function destroy($id)
    {
        $question = $this->faqQuestionService->getFaqQuestionById($id);
        if (!$question) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 404);
        }

        if (!$this->faqQuestionService->deleteFaqQuestion($question)) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 200);
    }
}
