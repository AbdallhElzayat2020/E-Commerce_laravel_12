<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\PageRequest;
use App\Services\Dashboard\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        return view('dashboard.pages.pages.index');
    }


    public function getAll()
    {
        return $this->pageService->getPagesForDataTables();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->only(['title', 'content', 'image']);
        $page = $this->pageService->createPage($data);

        if (!$page) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.pages.index')->with('success', __('dashboard.success_msg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = $this->pageService->getPage($id) ?? abort(404);
        return view('dashboard.pages.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $data = $request->only(['title', 'content', 'image']);
        $page = $this->pageService->updatePage($data, $id);

        if (!$page) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.pages.index')->with('success', __('dashboard.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->pageService->deletePage($id)) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 200);
    }
}
