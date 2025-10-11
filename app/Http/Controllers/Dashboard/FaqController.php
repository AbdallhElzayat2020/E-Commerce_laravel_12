<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\StoreFaqRequest;
use App\Http\Requests\Dashboard\Update\UpdateFaqRequest;
use App\Services\Dashboard\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    protected $faqService;

    public function __construct(Faqservice $faqService)
    {
        $this->faqService = $faqService;
    }


    public function index()
    {
        $faqs = $this->faqService->getFaqs();
        return view('dashboard.pages.faqs.index', compact('faqs'));
    }


    public function create()
    {
        return view('dashboard.pages.faqs.create');
    }


    public function store(StoreFaqRequest $request)
    {
        $data = $request->except('_token');
        $this->faqService->createFaq($data);

        flash()->success(__('dashboard.success_msg'));
        return redirect()->route('dashboard.faqs.index');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $faq = $this->faqService->getFaqById($id);
        return view('dashboard.pages.faqs.edit', compact('faq'));
    }


    public function update(UpdateFaqRequest $request, string $id)
    {

        $data = $request->except('_token', '_method');
        $this->faqService->updateFaq($id, $data);

        flash()->success(__('dashboard.success_msg'));
        return redirect()->route('dashboard.faqs.index');
    }


    public function destroy(string $id)
    {
        $this->faqService->deleteFaq($id);

        flash()->success(__('dashboard.deleted_successfully'));
        return redirect()->route('dashboard.faqs.index');
    }
}
