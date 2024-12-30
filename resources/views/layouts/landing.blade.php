<!DOCTYPE html>
<html lang="en">

<head>
    @include('shared.landing.head')
    @yield('styles')
</head>

<body>
    <!-- Spinner Start -->
    @include('shared.landing.loader')
    <!-- Spinner End -->


    <!-- Topbar Start -->
    @include('shared.landing.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('shared.landing.navbar')
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    @include('shared.landing.footer')
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    @yield('scripts')
    @include('shared.landing.script')

</body>

</html>
