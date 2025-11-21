<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="{{ route('dashboard.home') }}"><i class="la la-home">
                    </i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
                </a>
            </li>

            @can('categories')
                <li class=" nav-item">
                    <a href="#"><i class="la la-list-alt"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.categories') }}</span>
                        @if (isset($categories_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $categories_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.categories.create') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.category_create') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.categories.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.categories') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('brands')
                <li class=" nav-item">
                    <a href="#"><i class="la la-bookmark"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.brands') }}</span>
                        @if (isset($brands_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $brands_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.brands.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.brands') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('roles')
                <li class=" nav-item">
                    <a href="#"><i class="la la-shield"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('sidebar.dashboard_roles') }}</span>
                        @if (isset($roles_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $roles_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.roles.create') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard_roles.create_role') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.roles.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard_roles.roles') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('admins')
                <li class=" nav-item">
                    <a href="#"><i class="la la-users"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard_admins.title') }}</span>
                        @if (isset($admins_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $admins_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.admins.create') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard_admins.buttons.create') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.admins.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard_admins.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('coupons')
                <li class=" nav-item">
                    <a href="#"><i class="la la-ticket"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.coupons') }}</span>
                        @if (isset($coupons_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $coupons_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.coupons.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.coupons') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('faqs')
                <li class=" nav-item">
                    <a href="#"><i class="la la-question-circle"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.faqs') }}</span>
                        @if (isset($faqs_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $faqs_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.faqs.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.faqs') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.faqs.questions.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.faq_questions') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('shipping_countries')
                <li class=" nav-item">
                    <a href="#"><i class="la la-truck"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.shipping') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.countries.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.shipping') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


            <li class=" nav-item">
                <a href="#"><i class="la la-cog"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.settings') }}</span>
                </a>
                <ul class="menu-content">
                    @can('settings')
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.settings.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.settings') }}
                            </a>
                        </li>
                    @endcan
                    @can('sliders')
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.sliders.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.sliders') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('products')
                <li class=" nav-item">
                    <a href="#"><i class="la la-cubes"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.products') }}</span>
                    </a>
                    <ul class="menu-content">
                        @can('attributes')
                            <li>
                                <a class="menu-item" href="{{ route('dashboard.attributes.index') }}"
                                   data-i18n="nav.templates.vert.overlay_menu">
                                    {{ __('dashboard.attributes') }}
                                </a>
                            </li>
                        @endcan
                        @can('products')
                            <li>
                                <a class="menu-item" href="{{ route('dashboard.products.index') }}"
                                   data-i18n="nav.templates.vert.overlay_menu">
                                    {{ __('dashboard.products') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('users')
                <li class=" nav-item">
                    <a href="#"><i class="la la-users"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.users') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.users.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.users') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('users')
                <li class=" nav-item">
                    <a href="#"><i class="la la-users"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.pages') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.pages.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.pages') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('contacts')
                <li class=" nav-item">
                    <a href="#"><i class="la la-question-circle"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.contacts') }}</span>
                        @if (isset($contacts_count))
                            <span class="badge badge badge-info badge-pill float-right mr-2">{{ $contacts_count }}</span>
                        @endif
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.contacts.index') }}"
                               data-i18n="nav.templates.vert.overlay_menu">
                                {{ __('dashboard.contacts') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


        </ul>
    </div>
</div>
