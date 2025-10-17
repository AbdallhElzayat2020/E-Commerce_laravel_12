<?php

namespace App\Repositories\Dashboard;

use App\Models\AttributeValue;

class AttributeValueRepository
{
    public function createAttributeValues($attribute, $value)
    {
        return $attribute->attributeValues()->create([
            'value' => $value,
        ]);
    }
}
