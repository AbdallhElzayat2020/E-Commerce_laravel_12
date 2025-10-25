@extends('dashboard.layouts.master')

@section('title')
    {{ __('dashboard.products_show') }}
@endsection

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.products_show') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">
                                {{ __('dashboard.products') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $product->name }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-11">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">
                            {{ $product->name }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- Product Details -->
                                <div class="col-md-6">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="text-muted">{{ $product->small_desc }}</p>
                                    <p>{{ $product->desc }}</p>

                                    <!-- Price and Discount -->
                                    <div class="mt-2">
                                        @if ($product->has_variants)
                                            <span class="badge badge-warning">Has Variants</span>
                                        @else
                                            <h4>
                                                <span class="text-danger">
                                                    ${{ $product->price }}
                                                </span>
                                                @if ($product->has_discount)
                                                    <small class="text-muted">
                                                        <del>${{ $product->price + $product->discount }}</del>
                                                    </small>
                                                @endif
                                            </h4>
                                            @if ($product->manage_stock && !$product->has_variants)
                                                <h4>
                                                    <span class="text-muted">
                                                        {{ $product->quantity }}
                                                    </span>
                                                </h4>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Availability -->
                                    <div class="mt-3">
                                        <p>
                                            <i class="fa fa-calendar-check text-success"></i>
                                            Available For:
                                            {{ $product->available_for ? $product->available_for : 'N/A' }}
                                        </p>
                                        <p>
                                            <i class="fa fa-box text-primary"></i>
                                            In Stock: {{ $product->available_in_stock ? 'Yes' : 'No' }}
                                        </p>
                                    </div>

                                    <!-- SKU -->
                                    <div>
                                        <p>
                                            <i class="fa fa-barcode text-info"></i>
                                            SKU: {{ $product->sku }}
                                        </p>
                                    </div>

                                    <!-- Views -->
                                    <div>
                                        <p>
                                            <i class="fa fa-eye text-secondary"></i>
                                            Views: {{ $product->views }}
                                        </p>
                                    </div>

                                    <!-- Category and Brand -->
                                    <div class="mt-2">
                                        <p>
                                            <i class="fa fa-tag text-warning"></i>
                                            Category: {{ $product->category->name }}
                                        </p>
                                        <p>
                                            <i class="fa fa-industry text-danger"></i>
                                            Brand: {{ $product->brand->name }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Product Image -->
                                <div class="col-md-6 text-center">
                                    <!-- Product Image Slider -->
                                    <div id="productImageSlider" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $key => $image)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('uploads/products/' . $image->file_name) }}"
                                                        class="d-block w-100 rounded shadow-sm" alt="{{ $product->name }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#productImageSlider" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productImageSlider" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#fullscreenModal">
                                            <i class="fa fa-expand"></i> View Fullscreen
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Variants Section -->
                            <hr>
                            @if ($product->has_variants)
                                <div class="mt-5">
                                    <h4>Product Variants</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Attributes</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->variants as $variant)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>${{ $variant->price }}</td>
                                                        <td>{{ $variant->stock }}</td>
                                                        <td>
                                                            @foreach ($variant->VariantAttribute as $variantAttribute)
                                                                <span class="badge badge-primary">
                                                                    {{ $variantAttribute->attributeValue->attribute->name }}:
                                                                    {{ $variantAttribute->attributeValue->value }}
                                                                </span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a href=""></a>

                                                            @if ($product->variants()->count() > 1)
                                                                <form id="delete-variant-form-{{ $variant->id }}"
                                                                    action="{{ route('dashboard.products.variants.delete', $variant->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('post')
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        onclick="event.preventDefault(); if(confirm('are you sure you want to delete this variant?')) { document.getElementById('delete-variant-form-{{ $variant->id }}').submit(); }">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <span class="badge badge-danger">
                                                                    Can't delete the last variant
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">This product has no variants.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-secondary">
                        <i class="fa fa-edit"></i> Edit Product
                    </a>
                    <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Products
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal -->
    <div class="modal fade" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullscreenModalLabel">Fullscreen View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('uploads/products/' . $image->file_name) }}" class="d-block w-100"
                                        alt="Fullscreen Image">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#fullscreenCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#fullscreenCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
