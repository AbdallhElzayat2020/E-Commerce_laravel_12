@extends('dashboard.layouts.master')
@section('title')
    {{ __('dashboard.settings') }}
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.settings') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('dashboard.settings') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="{{ route('dashboard.settings.update', $setting->id) }}" method="POST"
                            enctype="multipart/form-data" class="form form-horizontal row-separator">
                            @csrf
                            @method('PUT')

                            <div class="form-body">

                                {{-- basic info --}}
                                <h4 class="form-section"><i class="la la-eye"></i> {{ __('dashboard.basic_settings') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_name_ar">{{ __('dashboard.site_name_ar') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="site_name_ar" class="form-control border-primary"
                                                    placeholder="{{ __('dashboard.site_name_ar') }}" name="site_name[ar]"
                                                    value="{{ old('site_name.ar', $setting->getTranslation('site_name', 'ar')) }}">
                                                @error('site_name.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_name_en">{{ __('dashboard.site_name_en') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="site_name_en" class="form-control border-primary"
                                                    placeholder="{{ __('dashboard.site_name_en') }}" name="site_name[en]"
                                                    value="{{ old('site_name.en', $setting->getTranslation('site_name', 'en')) }}">
                                                @error('site_name.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_desc_ar">{{ __('dashboard.site_desc_ar') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" id="site_desc_ar" name="site_desc[ar]" class="form-control border-primary">{{ old('site_desc.ar', $setting->getTranslation('site_desc', 'ar')) }}</textarea>
                                                @error('site_desc.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_desc_en">{{ __('dashboard.site_desc_en') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" id="site_desc_en" name="site_desc[en]" class="form-control border-primary">{{ old('site_desc.en', $setting->getTranslation('site_desc', 'en')) }}</textarea>
                                                @error('site_desc.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="meta_description_ar">{{ __('dashboard.meta_description_ar') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" id="meta_description_ar" name="meta_description[ar]" class="form-control border-primary">{{ old('meta_description.ar', $setting->getTranslation('meta_description', 'ar')) }}</textarea>
                                                @error('meta_description.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="meta_description_en">{{ __('dashboard.meta_description_en') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" id="meta_description_en" name="meta_description[en]" class="form-control border-primary">{{ old('meta_description.en', $setting->getTranslation('meta_description', 'en')) }}</textarea>
                                                @error('meta_description.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="site_address_ar">{{ __('dashboard.site_address_ar') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="site_address_ar"
                                                    class="form-control border-primary"
                                                    placeholder="{{ __('dashboard.site_address_ar') }}"
                                                    name="site_address[ar]"
                                                    value="{{ old('site_address.ar', $setting->getTranslation('site_address', 'ar')) }}">
                                                @error('site_address.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="site_address_en">{{ __('dashboard.site_address_en') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="site_address_en"
                                                    class="form-control border-primary"
                                                    placeholder="{{ __('dashboard.site_address_en') }}"
                                                    name="site_address[en]"
                                                    value="{{ old('site_address.en', $setting->getTranslation('site_address', 'en')) }}">
                                                @error('site_address.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="site_copyright">{{ __('dashboard.site_copyright') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="site_copyright"
                                                    class="form-control border-primary"
                                                    placeholder="{{ __('dashboard.site_copyright') }}"
                                                    name="site_copyright"
                                                    value="{{ old('site_copyright', $setting->site_copyright) }}">
                                                @error('site_copyright')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end basic info --}}

                                {{-- contact info --}}
                                <h4 class="form-section"><i class="la la-envelope"></i>
                                    {{ __('dashboard.contact_info') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_email">{{ __('dashboard.email') }}</label>
                                            <div class="col-md-9">
                                                <input name="site_email" class="form-control border-primary"
                                                    type="email" placeholder="{{ __('dashboard.email') }}"
                                                    id="site_email"
                                                    value="{{ old('site_email', $setting->site_email) }}">
                                                @error('site_email')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="email_support">{{ __('dashboard.email_support') }}</label>
                                            <div class="col-md-9">
                                                <input name="email_support" class="form-control border-primary"
                                                    type="email" placeholder="{{ __('dashboard.email_support') }}"
                                                    id="email_support"
                                                    value="{{ old('email_support', $setting->email_support) }}">
                                                @error('email_support')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="site_phone">{{ __('dashboard.phone') }}</label>
                                            <div class="col-md-9">
                                                <input name="site_phone" class="form-control border-primary"
                                                    type="text" placeholder="{{ __('dashboard.phone') }}"
                                                    id="site_phone"
                                                    value="{{ old('site_phone', $setting->site_phone) }}">
                                                @error('site_phone')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end contact info --}}

                                {{-- social --}}
                                <h4 class="form-section"><i class="la la-share-alt"></i> {{ __('dashboard.social') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="facebook_url">{{ __('dashboard.facebook') }}</label>
                                            <div class="col-md-9">
                                                <input name="facebook_url" class="form-control border-primary"
                                                    type="url" placeholder="{{ __('dashboard.facebook') }}"
                                                    id="facebook_url"
                                                    value="{{ old('facebook_url', $setting->facebook_url) }}">
                                                @error('facebook_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="youtube_url">{{ __('dashboard.youtube') }}</label>
                                            <div class="col-md-9">
                                                <input name="youtube_url" class="form-control border-primary"
                                                    type="url" placeholder="{{ __('dashboard.youtube') }}"
                                                    id="youtube_url"
                                                    value="{{ old('youtube_url', $setting->youtube_url) }}">
                                                @error('youtube_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="x_url">{{ __('dashboard.x') }}</label>
                                            <div class="col-md-9">
                                                <input name="x_url" class="form-control border-primary" type="url"
                                                    placeholder="{{ __('dashboard.x') }}" id="x_url"
                                                    value="{{ old('x_url', $setting->x_url) }}">
                                                @error('x_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end social --}}

                                {{-- Media --}}
                                <h4 class="form-section"><i class="la la-image"></i> {{ __('dashboard.media') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="logo">{{ __('dashboard.logo') }}</label>
                                            <div class="col-md-9">
                                                <input name="logo" id="logo-image" class="form-control border-primary"
                                                    type="file" placeholder="{{ __('dashboard.logo') }}">
                                                @error('logo')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                                @if ($setting->logo)
                                                    <div class="mt-2">
                                                        <img src="{{ asset($setting->logo) }}" alt="Logo"
                                                            class="img-thumbnail" style="max-width: 150px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="favicon">{{ __('dashboard.favicon') }}</label>
                                            <div class="col-md-9">
                                                <input name="favicon" id="favicon-image"
                                                    class="form-control border-primary" type="file"
                                                    placeholder="{{ __('dashboard.favicon') }}">
                                                @error('favicon')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                                @if ($setting->favicon)
                                                    <div class="mt-2">
                                                        <img src="{{ asset($setting->favicon) }}" alt="Favicon"
                                                            class="img-thumbnail" style="max-width: 150px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="promotion_video_url">{{ __('dashboard.promotion_video_url') }}</label>
                                            <div class="col-md-9">
                                                <input name="promotion_video_url" class="form-control border-primary"
                                                    type="text"
                                                    placeholder="{{ __('dashboard.promotion_video_url') }}"
                                                    id="promotion_video_url"
                                                    value="{{ old('promotion_video_url', $setting->promotion_video_url) }}">
                                                @error('promotion_video_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end media --}}
                            </div>
                            {{-- buttons --}}
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check"></i> {{ __('dashboard.save') }}
                                </button>
                            </div>
                            {{-- end button --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- File Input Preview (Logo & Favicon) --}}
    <script>
        $(function() {
            // Preview for Logo
            $('#logo-image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = $(this).closest('.form-group').find('.img-thumbnail');
                        if (preview.length) {
                            preview.attr('src', e.target.result);
                        } else {
                            $(this).closest('.col-md-9').append('<div class="mt-2"><img src="' + e
                                .target.result +
                                '" alt="Logo Preview" class="img-thumbnail" style="max-width: 150px;"></div>'
                                );
                        }
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });

            // Preview for Favicon
            $('#favicon-image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = $(this).closest('.form-group').find('.img-thumbnail');
                        if (preview.length) {
                            preview.attr('src', e.target.result);
                        } else {
                            $(this).closest('.col-md-9').append('<div class="mt-2"><img src="' + e
                                .target.result +
                                '" alt="Favicon Preview" class="img-thumbnail" style="max-width: 150px;"></div>'
                                );
                        }
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
