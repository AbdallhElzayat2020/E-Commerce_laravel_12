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
    protected $attribute, $attributeValue;

    public function __construct(AttributeRepository $attributeRepository, AttributeValueRepository $attributeValueRepository)
    {
        $this->attribute = $attributeRepository;
        $this->attributeValue = $attributeValueRepository;
    }

    public function getAttribute($id)
    {
        $attribute = $this->attribute->getAttribute($id);
        return $attribute ?? abort(404, 'Attribute Not Found');
    }

    public function getAttributes()
    {
        return $this->attribute->getAttributes();
    }

    public function getAttributesForDatatables()
    {
        $attributes = $this->getAttributes();
        return DataTables::of($attributes)
            ->addIndexColumn()

            ->addColumn('name', function ($item) {
                return $item->getTranslation('name', app()->getLocale());
            })

            ->addColumn('attributeValues', function ($item) {
                return view('dashboard.pages.products.attributes.datatables.attributeValues', compact('item'));
            })

            ->addColumn('actions', function ($item) {
                return view('dashboard.pages.products.attributes.datatables.actions', compact('item'));
            })

            ->make(true);
    }

    public function createAttribute($data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attribute->createAttribute($data);

            foreach ($data['value'] as $value) {
                $this->attributeValue->createAttributeValues($attribute, $value);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating attribute: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return false;
        }
    }

    public function updateAttribute($data, $id)
    {
        try {
            $attribute_obj = $this->getAttribute($id);

            DB::beginTransaction();
            $this->attribute->updateAttribute($attribute_obj, $data);

            $this->attributeValue->deleteAttributeValues($attribute_obj);
            foreach ($data['value'] as $value) {
                $this->attributeValue->createAttributeValues($attribute_obj, $value);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating attribute: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return false;
        }
    }

    public function deleteAttribute($id)
    {
        $attribute = $this->getAttribute($id);
        return $this->attribute->deleteAttribute($attribute);
    }
}
