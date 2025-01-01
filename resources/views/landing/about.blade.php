@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-3 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" data-wow-delay="0.1s" src="assets/landing/img/about.jpg">
                </div>
                <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-1 text-primary mb-0">25</h1>
                    <p class="text-primary mb-4">Tahun Pengalaman</p>
                    <h1 class="display-5 mb-4">Kami Membuat Pakaian Anda Bersih Seperti Baru</h1>
                    <p class="mb-4">Dengan pengalaman lebih dari 25 tahun, kami telah melayani berbagai kebutuhan laundry Anda, mulai dari cuci biasa hingga dry cleaning. Kami berkomitmen untuk memberikan hasil yang memuaskan dengan menggunakan peralatan modern dan bahan pembersih berkualitas tinggi. Setiap pakaian yang Anda percayakan kepada kami akan diproses dengan penuh perhatian dan ketelitian, memastikan bahwa pakaian Anda kembali dalam kondisi terbaik seperti baru.</p>
                    <p class="mb-4">Kami percaya bahwa kepuasan pelanggan adalah hal yang utama. Oleh karena itu, tim kami yang profesional selalu siap memberikan layanan terbaik untuk memenuhi kebutuhan laundry Anda. Dengan berbagai penghargaan yang telah kami raih, kami berusaha terus meningkatkan layanan kami agar tetap menjadi pilihan utama bagi Anda. Jelajahi lebih lanjut tentang layanan kami dan temukan bagaimana kami dapat membantu menjaga kebersihan pakaian Anda dengan sempurna.</p>
                    <a class="btn btn-primary py-3 px-4" href="javascript:void(0)">Jelajahi Lebih Lanjut</a>
                </div>
                <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-5">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <i class="fa fa-award fa-3x text-primary mb-3"></i>
                                <h4 class="mb-3">Pemenang Penghargaan</h4>
                                <span>Kami meraih berbagai penghargaan untuk kualitas layanan laundry kami yang
                                    unggul.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <i class="fa fa-users fa-3x text-primary mb-3"></i>
                                <h4 class="mb-3">Tim Profesional</h4>
                                <span>Tim kami terdiri dari tenaga ahli yang berkomitmen untuk memberikan hasil laundry
                                    terbaik bagi Anda.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endSection

@section('scripts')
    {{-- Scripts --}}
@endsection
