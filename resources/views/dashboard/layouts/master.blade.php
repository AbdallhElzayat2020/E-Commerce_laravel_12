<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

@include('dashboard.layouts.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    @include('dashboard.layouts.navbar')
    @include('dashboard.layouts.sidebar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    @include('dashboard.layouts.footer')
    @include('dashboard.layouts.scripts')
</body>

</html>
