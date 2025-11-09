<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\SliderRequest;
use App\Http\Requests\Dashboard\Update\SliderRequest as UpdateSliderRequest;
use App\Services\Dashboard\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }


    public function getAll()
    {
        return $this->sliderService->getSlidersForDataTables();
    }

    public function index()
    {
        return view('dashboard.pages.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $data = $request->only(['note', 'file_name']);
        $slider = $this->sliderService->createSlider($data);

        if (!$slider) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.sliders.index')->with('success', __('dashboard.success_msg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sliderData = $this->sliderService->getSliderForEdit($id);

        if (!$sliderData) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'slider' => $sliderData
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $data = $request->only(['note', 'file_name']);
        $slider = $this->sliderService->updateSlider($id, $data);

        if (!$slider) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('dashboard.error_msg')
                ], 404);
            }
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg')
            ], 200);
        }

        return redirect()->route('dashboard.sliders.index')->with('success', __('dashboard.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->sliderService->deleteSlider($id)) {
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
