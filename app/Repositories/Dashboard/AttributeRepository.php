<?php

namespace App\Repositories\Dashboard;

use App\Models\Attribute;

class AttributeRepository
{
    public function getAttributes()
    {
        return Attribute::with('attributeValues')->latest()->get();
    }

    public function createAttribute($data)
    {
        return Attribute::create([
            'name' => $data['name'],
        ]);
    }
}
