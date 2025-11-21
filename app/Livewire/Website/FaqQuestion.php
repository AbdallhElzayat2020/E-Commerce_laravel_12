<?php

namespace App\Livewire\Website;

use App\Services\Website\FaqService;
use Livewire\Component;

class FaqQuestion extends Component
{

    public $name, $email, $subject, $message;

    protected FaqService $faqService;

    public function boot(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:200',
            'email' => 'required|email|max:200',
            'subject' => 'required|min:2|max:200',
            'message' => 'required|min:3|max:5000',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function submit()
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        $faq = $this->faqService->createFaqQuestion($data);
        if (!$faq) {
            $this->dispatch('faq-question-failed', 'Something went wrong');
        }
        $this->reset();
        $this->dispatch('faq-question-created', 'Your message has been sent successfully');
    }

    public function render()
    {
        return view('livewire.website.faq-question');
    }
}
