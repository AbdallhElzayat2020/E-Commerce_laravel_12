<section id="icon-tabs">

    @if (!empty($successMessage))
        <div class="alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ __('dashboard.well_done') }}!</strong> {{ $successMessage }}
        </div>
    @endif

    {{-- list of step --}}
    <ul class="wizard-timeline center-align">
        <li class="{{ $currentStep > 1 ? 'completed' : '' }}">
            <span class="step-num">1</span>
            <label>{{ __('dashboard.basic_information') }}</label>
        </li>
        <li class="{{ $currentStep > 2 ? 'completed' : '' }}">
            <span class="step-num">2</span>
            <label>{{ __('dashboard.product_variants') }}</label>
        </li>
        <li class="active {{ $currentStep > 3 ? 'completed' : '' }}">
            <span class="step-num">3</span>
            <label>{{ __('dashboard.product_images') }}</label>
        </li>
        <li class="{{ $currentStep == 4 ? 'completed' : '' }}">
            <span class="step-num">4</span>
            <label>{{ __('dashboard.confirmation') }}</label>
        </li>
    </ul>


    <form class="wizard-circle">

        {{-- first step Product Basic Info --}}
        <div class="setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
            <h3> Step 1</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName2"> {{ __('dashboard.product_name_ar') }} :</label>
                        <input wire:model.live="name_ar" type="text" class="form-control" id="firstName2"
                            placeholder="{{ __('dashboard.product_name_ar') }}">
                        @error('name_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName2"> {{ __('dashboard.product_name_en') }} :</label>
                        <input wire:model.live="name_en" type="text" class="form-control" id="firstName2"
                            placeholder="{{ __('dashboard.product_name_en') }}">
                        @error('name_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress3"> {{ __('dashboard.small_description_ar') }}
                            :</label>
                        <textarea wire:model.live="small_desc_ar" class="form-control" id="emailAddress3"></textarea>
                        @error('small_desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress3"> {{ __('dashboard.small_description_en') }}
                            :</label>
                        <textarea wire:model.live="small_desc_en" class="form-control" id="emailAddress3"></textarea>
                        @error('small_desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location2"> {{ __('dashboard.description_ar') }} :</label>
                        <textarea wire:model.live="desc_ar" class="form-control" id="emailAddress3"></textarea>
                        @error('desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location2"> {{ __('dashboard.description_en') }} :</label>
                        <textarea wire:model.live="desc_en" class="form-control" id="emailAddress3"></textarea>
                        @error('desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category"> {{ __('dashboard.category') }} :</label>
                        <select wire:model.live="category_id" class="form-control custom-select" id="category">
                            <option value=""> {{ __('dashboard.select_category') }} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="brand"> {{ __('dashboard.brand') }} :</label>
                        <select wire:model.live="brand_id" class="form-control custom-select" id="brand">
                            <option value=""> {{ __('dashboard.select_brand') }} </option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lastName2"> {{ __('dashboard.product_sku') }} :</label>
                        <input wire:model.live="sku" type="text" class="form-control" id="lastName2">
                        @error('sku')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date"> {{ __('dashboard.available_for') }} :</label>
                        <input wire:model.live="available_for" type="date" class="form-control" id="date">
                        @error('available_for')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date"> {{ __('dashboard.product_tags') }} :</label>
                        <input type="text" wire:model="tags" id="tagInput" class="form-control"
                            placeholder="Add tags">
                        @error('tags')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

            </div>
            <button class="btn btn-primary pull-right mb-3" wire:click="firstStepSubmit" type="button">
                {{ __('dashboard.next') }}
            </button>
        </div>

        {{-- second step Product Variants? --}}
        <div class="setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            {{-- Basic --}}
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label for="images"> {{ __('dashboard.has_variants') }} :</label>
                        <select name="has_variants" id="has_variants" wire:model.live="has_variants"
                            class="form-control">
                            <option value="0" selected>{{ __('dashboard.no') }}</option>
                            <option value="1">{{ __('dashboard.yes') }}</option>
                        </select>
                        @error('has_variants')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if ($has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">{{ __('dashboard.price') }} :</label>
                            <input type="number" class="form-control" name="price" id="price"
                                wire:model.live="price" placeholder="{{ __('dashboard.price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                @if ($has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">{{ __('dashboard.manage_stock') }} :</label>
                            <select id="status" class="form-control" wire:model.live="manage_stock">
                                <option value="0" selected>{{ __('dashboard.no') }}</option>
                                <option value="1">{{ __('dashboard.yes') }}</option>
                            </select>
                            @error('manage_stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- depend on Manage stock --}}
                @if ($manage_stock == 1 && $has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">{{ __('dashboard.quantity') }} :</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                wire:model.live="quantity" placeholder="{{ __('dashboard.quantity') }}">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- edit this part --}}
                @if ($has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">{{ __('dashboard.has_discount') }} :</label>
                            <select name="status" id="status" class="form-control"
                                wire:model.live="has_discount">
                                <option value="0" selected>{{ __('dashboard.no_discount') }}</option>
                                <option value="1">{{ __('dashboard.has_discount') }}</option>
                            </select>
                            @error('has_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- depend on has discount --}}
                @if ($has_discount == 1 && $has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="discount">{{ __('dashboard.discount') }}</label>
                            <input class="form-control" type="number" wire:model.live="discount"
                                placeholder="{{ __('dashboard.discount') }}">
                            @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="start_discount">{{ __('dashboard.start_discount') }}</label>
                            <input type="date" wire:model.live="start_discount" class="form-control"
                                placeholder="{{ __('dashboard.start_discount') }}">
                            @error('start_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="end_discount">{{ __('dashboard.end_discount') }}</label>
                            <input type="date" wire:model.live="end_discount" class="form-control"
                                placeholder="{{ __('dashboard.end_discount') }}">
                            @error('end_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>


            {{-- variants --}}
            @if ($has_variants == 1)
                <hr class="bg-black">

                @for ($i = 0; $i < $valueRowCount; $i++)
                    <div class="row">
                        <hr>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input wire:model="prices.{{ $i }}" type="number" class="form-control"
                                    placeholder="Product Price">
                                @error('prices.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">Product Quantity</label>
                                <input wire:model="quantities.{{ $i }}" type="number"
                                    class="form-control" placeholder="Product Quantity">
                                @error('quantities.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($attributes as $attr)
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="price">Product {{ $attr->name }}</label>
                                    <select wire:model="attributeValues.{{ $i }}.{{ $attr->id }}"
                                        class="form-control">
                                        <option value="" selected>Select</option>

                                        @foreach ($attr->attributeValues as $item)
                                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <hr class="bg-black">
                @endfor

                <button type="button" wire:click="addNewVariant" class="btn btn-success"><i class="la la-plus"></i>
                    Add New Variant
                </button>
                <button type="button" wire:click="removeVariant" class="btn btn-danger"><i class="la la-minus"></i>
                    Remove Variant
                </button>

            @endif


            <button class="btn btn-primary pull-right  mb-3 ml-1" type="button"
                wire:click="secondStepSubmit">{{ __('dashboard.next') }}</button>
            <button class="btn btn-danger  pull-right" type="button"
                wire:click="back(1)">{{ __('dashboard.back') }}</button>
        </div>

        {{-- third step Product Images --}}
        <div class="setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="images"> {{ __('dashboard.product_images') }} :</label>
                        <input type="file" wire:model.live="images" class="form-control" multiple>
                    </div>
                </div>
                @error('images')
                    <div class="col-md-12 alert  alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                @if ($images)
                    <div class="col-md-12">
                        @foreach ($images as $key => $image)
                            <div class="position-relative d-inline-block mr-2 mb-2">
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail rounded-md"
                                    width="300px" height="300px" alt="image">

                                {{-- Delete Button --}}
                                <button type="button" wire:click="deleteImage({{ $key }})"
                                    class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Fullscreen Button -->
                                <button type="button" wire:click="openFullscreen({{ $key }})"
                                    class="btn btn-primary btn-sm position-absolute" style="bottom: 5px; right: 5px;">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Fullscreen Modal (Optional) -->
            <div wire:ignore.self class="modal fade" id="fullscreenModal" tabindex="-1"
                aria-labelledby="fullscreenModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ $fullscreenImage }}" class="img-fluid" id="fullscreenImage"
                                alt="Full Screen Image">
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success  pull-right  mb-3 ml-1" wire:click="thirdStepSubmit" type="button">
                {{ __('dashboard.next') }}!
            </button>

            <button class="btn btn-danger  pull-right  mb-3" type="button" wire:click="back(2)">
                {{ __('dashboard.back') }}
            </button>

        </div>

        {{-- Confirm Step Display Data --}}
        <div class="setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
            <div class="row">

                <!-- Product Details -->

            </div>

            <button class="btn btn-success  pull-right  mb-3 ml-1" wire:click="submitForm"
                type="button">{{ __('dashboard.confirm') }}!
            </button>

            <button class="btn btn-danger  pull-right  mb-3" type="button" wire:click="back(3)">
                {{ __('dashboard.back') }}
            </button>

        </div>

    </form>


</section>
