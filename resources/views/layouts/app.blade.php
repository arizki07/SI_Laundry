<!doctype html>
<html lang="en">

<head>
    @include('shared.header')
    @yield('styles')
</head>

<body>
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
    @include('shared.script')
    @yield('scripts')
</body>

</html>
