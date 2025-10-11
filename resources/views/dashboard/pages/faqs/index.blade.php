@extends('dashboard.layouts.master')
@section('title', __('dashboard.faqs'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.faqs') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('dashboard.faqs.create') }}" class="btn btn-outline-success">
                            <i class="la la-plus"></i> {{ __('dashboard.create_faq') }}
                        </a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="accordion">
                                @forelse($faqs as $faq)
                                    <div role="tab" id="heading{{ $faq->id }}" class="card-header border-success">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <a data-toggle="collapse" href="#collapse{{ $faq->id }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $faq->id }}"
                                                    class="font-medium-1 success" data-parent="#accordion">
                                                    {{ $faq->question }} # {{ $loop->iteration }}
                                                </a>
                                                <span
                                                    class="badge badge-{{ $faq->status == 'active' ? 'success' : 'danger' }} ml-2">
                                                    {{ $faq->status == 'active' ? __('dashboard.active') : __('dashboard.inactive') }}
                                                </span>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dashboard.faqs.edit', $faq->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <form action="{{ route('dashboard.faqs.destroy', $faq->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('{{ __('dashboard.are_you_sure') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapse{{ $faq->id }}" role="tabpanel"
                                        aria-labelledby="heading{{ $faq->id }}"
                                        class="card-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-warning">
                                        {{ __('dashboard.not_found') }}
                                    </div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
