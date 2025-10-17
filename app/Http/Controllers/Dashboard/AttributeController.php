<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\StoreAttributeRequest;
use App\Models\Attribute;
use App\Services\Dashboard\AttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    protected $attributeService;

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
        return $this->attributeService->getAttributesForDataTables();
    }

    public function create()
    {
        //
    }


    public function store(StoreAttributeRequest $request)
    {


        $data = $request->except('_token');

        $attribute = $this->attributeService->createAttribute($data);

        if (!$attribute) {
            return redirect()->back()
                ->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.attributes.index')
            ->with(['success' => __('dashboard.success_msg')]);

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
