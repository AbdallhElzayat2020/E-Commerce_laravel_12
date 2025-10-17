<?php

namespace App\Services\Dashboard;

use App\Models\Attribute;
use App\Repositories\Dashboard\AttributeRepository;
use App\Repositories\Dashboard\AttributeValueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AttributeService
{
    protected $attributeRepository, $attributeValueRepository;

    public function __construct(AttributeRepository $attributeRepository, AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function getAttributes()
    {
        return $this->attributeRepository->getAttributes();
    }

    public function getAttributesForDataTables()
    {
        $attributes = $this->attributeRepository->getAttributes();
        return DataTables::of($attributes)
            ->addIndexColumn()
            ->addColumn('name', function ($attribute) {
                return $attribute->getTranslation('name', app()->getLocale());
            })
            ->addColumn('attributeValues', function ($item) {
                return view('dashboard.pages.products.attributes.datatables.actions', compact('item'))->render();
            })
            ->addColumn('created_at', function ($attribute) {
                return $attribute->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($item) {
                return view('dashboard.pages.products.attributes.datatables.attributeValues', compact('item'))->render();
            })
            ->rawColumns(['actions', 'attributeValues'])
            ->make(true);
    }


    public function createAttribute($data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->createAttribute($data);

            foreach ($data['value'] as $value) {
                $this->attributeValueRepository->createAttributeValues($attribute, $value);
            }
            DB::commit();
            return $attribute;

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
}
