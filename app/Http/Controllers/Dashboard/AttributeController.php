<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\AttributeRequest;
use App\Models\Attribute;
use App\Services\Dashboard\AttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    protected AttributeService $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index()
    {
        return view('dashboard.pages.products.attributes.index');
    }

    public function getAll()
    {
        return $this->attributeService->getAttributesForDatatables();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.products.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->except(['_token']);
        $attribute = $this->attributeService->createAttribute($data);
        if (!$attribute) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 201);
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, string $id)
    {
        $data = $request->except(['_token']);
        $attribute = $this->attributeService->updateAttribute($data, $id);
        if (!$attribute) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->attributeService->deleteAttribute($id)) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 200);
    }
}
