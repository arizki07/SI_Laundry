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
    @if ($act != 'err') 
        @include('shared.landing.footer')

        <a href="javascript:void(0)" class="whatsapp-btn">
            <i class="fab fa-whatsapp" style="font-size: 25px;"></i>
        </a>
    @else
    
    <div class="container-fluid copyright py-4" style="background-color: #004753;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="javascript:void(0)">{{ date('Y') }}</a> Indah Laundry, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="border-bottom" href="javascript:void(0)">Epon</a>
                </div>
            </div>
        </div>
    </div>
    
    <a href="javascript:void(0)" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
    @endif
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    @yield('scripts')
    @include('shared.landing.script')

</body>

</html>
