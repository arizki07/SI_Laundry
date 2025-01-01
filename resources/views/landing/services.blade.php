@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Layanan Kami</p>
                <h1 class="display-5 mb-5" style="font-size: 30px;">Layanan yang Kami Tawarkan untuk Anda</h1>
            </div>
            <div class="row g-4">
                <!-- Layanan Cuci Pakaian -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-1.jpg" alt="Cuci Pakaian">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-3.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Cuci Pakaian</h4>
                            <p class="mb-4">Layanan cuci pakaian kami memastikan pakaian Anda dicuci dengan sempurna dan
                                penuh perhatian.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Layanan Dry Cleaning -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-2.jpg" alt="Dry Cleaning">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-6.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Dry Cleaning</h4>
                            <p class="mb-4">Layanan dry cleaning kami memberikan perawatan terbaik untuk pakaian yang
                                membutuhkan perlakuan khusus.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Layanan Setrika -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-3.jpg" alt="Setrika Pakaian">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-5.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Setrika Pakaian</h4>
                            <p class="mb-4">Kami juga menyediakan layanan setrika untuk pakaian yang rapi dan siap
                                dipakai.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Layanan Cuci Sepatu -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-4.jpg" alt="Cuci Sepatu">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-4.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Cuci Sepatu</h4>
                            <p class="mb-4">Kami juga menyediakan layanan cuci sepatu dengan teknik yang menjaga kualitas
                                dan kebersihannya.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Layanan Pembersihan Karpet -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-5.jpg" alt="Pembersihan Karpet">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-8.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Pembersihan Karpet</h4>
                            <p class="mb-4">Pembersihan karpet dengan teknik terbaik, menghilangkan kotoran dan menjaga
                                kelembutannya.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Layanan Pembersihan Gorden -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="assets/landing/img/service-6.jpg" alt="Pembersihan Gorden">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/landing/img/icon/icon-2.png" alt="Ikon">
                            </div>
                            <h4 class="mb-3">Pembersihan Gorden</h4>
                            <p class="mb-4">Layanan cuci gorden dengan hasil yang bersih dan tanpa merusak bahan gorden
                                Anda.</p>
                            <a class="btn btn-sm" href="javascript:void(0)"><i
                                    class="fa fa-plus text-primary me-2"></i>Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endSection

@section('scripts')
    {{-- Scripts --}}
@endsection
