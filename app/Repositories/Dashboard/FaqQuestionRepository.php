<?php

namespace App\Repositories\Dashboard;

use App\Models\FaqQuestion;

class FaqQuestionRepository
{
    public function getFaqQuestionById($id)
    {
        return FaqQuestion::find($id);
    }

    public function getFaqQuestions()
    {
        return FaqQuestion::latest()->get();
    }

    public function deleteFaqQuestion($question)
    {
        return $question->delete();
    }
}
