<!doctype html>
<html lang="en">

@include('shared.header')
@yield('styles')

<body>
    @include('shared.script')
    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')
        <div class="page-wrapper">
            @yield('content')
            @include('shared.footer')
        </div>
    </div>
    @yield('modals')
    @include('components.alert')
    @yield('scripts')
</body>

</html>
