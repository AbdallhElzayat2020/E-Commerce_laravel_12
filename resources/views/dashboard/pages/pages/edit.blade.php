@extends('dashboard.layouts.master')
@section('title', __('dashboard.create_page'))
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.pages_table') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.pages.index') }}">
                                {{ __('dashboard.pages') }}</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">
                                {{ __('dashboard.edit_page') }}</a>
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
                            {{ __('dashboard.pages') }}
                        </h4>
                        <div class="card-content">
                            <div class="card-body">
                                {{-- alert --}}
                                @include('dashboard.includes.validations-errors')

                                <p class="card-text">{{ __('dashboard.form_edit') }}.</p>
                                <form class="form" action="{{ route('dashboard.pages.update',$page->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.title_ar') }}</label>
                                            <input type="text" value="{{ old('title[ar]',$page->getTranslation('title','ar'))}}" class="form-control"
                                                   placeholder="{{ __('dashboard.title_ar') }}" name="title[ar]">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.title_en') }}</label>
                                            <input type="text" value="{{ old('title[en]',$page->getTranslation('title','en'))}}" class="form-control"
                                                   placeholder="{{ __('dashboard.title_en') }}" name="title[en]">
                                        </div>

                                        {{-- content --}}
                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.content_ar') }}</label>
                                            <textarea id="summernote" type="text" class="form-control" name="content[ar]">{!! $page->getTranslation('content','ar')!!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.content_en') }}</label>
                                            <textarea id="summernote2" type="text" class="form-control" name="content[en]">{!! $page->getTranslation('content','en')!!}</textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="image">{{ __('dashboard.image') }}</label>
                                            <input type="file" name="image" class="form-control" id="single-image-edit"
                                                   placeholder="{{ __('dashboard.image') }}">
                                        </div>
                                    </div>

                                    <div class="form-actions left">
                                        <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
            <script>
                $('#summernote').summernote({
                    placeholder: 'Hello Bootstrap 4',
                    tabsize: 2,
                    height: 500,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
                $('#summernote2').summernote({
                    placeholder: 'Hello Bootstrap 4',
                    tabsize: 2,
                    height: 500,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });

                var lang = "{{ app()->getLocale() }}";
                $(function () {
                    $('#single-image-edit').fileinput({
                        theme: 'fa5',
                        language: lang,
                        allowedFileTypes: ['image'],
                        maxFileCount: 1,
                        enableResumableUpload: false,
                        showUpload: false,
                        initialPreviewAsData: true,
                        initialPreview: [
                            "{{ asset('uploads/pages/'.$page->image) }}",
                        ],

                    });

                });
            </script>
    @endpush
