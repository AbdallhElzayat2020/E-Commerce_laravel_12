<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <button class="btn btn-sm btn-outline-primary edit-attribute" data-id="{{ $item->id }}"
            data-name-ar="{{ $item->getTranslation('name', 'ar') }}"
            data-name-en="{{ $item->getTranslation('name', 'en') }}"
            data-values="{{ $item->attributeValues->map(
                    fn($value) => [
                        'id' => $value->id,
                        'value_ar' => $value->getTranslation('value', 'ar'),
                        'value_en' => $value->getTranslation('value', 'en'),
                    ],
                )->toJson() }}">
            {{ __('dashboard.edit') }} <i class="la la-edit"></i>
        </button>

        <button id="btnGroupDrop2" attribute-id="{{ $item->id }}" type="button"
            class="delete_confirm_btn btn btn-outline-danger">
            {{ __('dashboard.delete') }}<i class="la la-trash"></i>
        </button>


    </div>
</div>
