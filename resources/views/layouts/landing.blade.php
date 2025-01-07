<!DOCTYPE html>
<html lang="en">

<head>
    @include('shared.landing.head')
    @yield('styles')
</head>

<body>
    @php
        // dd($kontak);
        if ($kontak && !$kontak->logo) {
            $logo = asset('assets/static/avatars/super.jpg');
        } elseif ($kontak && $kontak->logo) {
            $logo = Storage::url($kontak->logo);
        } else {
            $logo = asset('assets/static/avatars/super.jpg');
        }
    @endphp

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

    <a href="javascript:void(0)" class="whatsapp-btn">
        <i class="fab fa-whatsapp" style="font-size: 25px;"></i>
    </a>

    <!-- JavaScript Libraries -->
    @yield('scripts')
    @include('shared.landing.script')

</body>

</html>
