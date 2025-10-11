@extends('dashboard.layouts.master')
@section('title', __('dashboard.edit_faq'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit_faq') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('dashboard.faqs.index') }}" class="btn btn-outline-primary">
                            <i class="la la-arrow-left"></i> {{ __('dashboard.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">

                        <form action="{{ route('dashboard.faqs.update', $faq->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="question_ar">{{ __('dashboard.question_ar') }}</label>
                                <input type="text" name="question[ar]"
                                    class="form-control @error('question.ar') is-invalid @enderror" id="question_ar"
                                    placeholder="{{ __('dashboard.question_ar') }}"
                                    value="{{ old('question.ar', $faq->getTranslation('question', 'ar')) }}" required>
                                @error('question.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="question_en">{{ __('dashboard.question_en') }}</label>
                                <input type="text" name="question[en]"
                                    class="form-control @error('question.en') is-invalid @enderror" id="question_en"
                                    placeholder="{{ __('dashboard.question_en') }}"
                                    value="{{ old('question.en', $faq->getTranslation('question', 'en')) }}" required>
                                @error('question.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="answer_ar">{{ __('dashboard.answer_ar') }}</label>
                                <textarea name="answer[ar]" class="form-control @error('answer.ar') is-invalid @enderror" id="answer_ar" rows="5"
                                    placeholder="{{ __('dashboard.answer_ar') }}" required>{{ old('answer.ar', $faq->getTranslation('answer', 'ar')) }}</textarea>
                                @error('answer.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="answer_en">{{ __('dashboard.answer_en') }}</label>
                                <textarea name="answer[en]" class="form-control @error('answer.en') is-invalid @enderror" id="answer_en" rows="5"
                                    placeholder="{{ __('dashboard.answer_en') }}" required>{{ old('answer.en', $faq->getTranslation('answer', 'en')) }}</textarea>
                                @error('answer.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('dashboard.status') }}</label>
                                <div class="input-group">
                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                        <input type="radio" value="active" name="status" class="custom-control-input"
                                            id="active_edit"
                                            {{ old('status', $faq->status) == 'active' ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="active_edit">{{ __('dashboard.active') }}</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio">
                                        <input type="radio" value="inactive" name="status" class="custom-control-input"
                                            id="inactive_edit"
                                            {{ old('status', $faq->status) == 'inactive' ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="inactive_edit">{{ __('dashboard.inactive') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                </button>
                                <a href="{{ route('dashboard.faqs.index') }}" class="btn btn-secondary">
                                    <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
