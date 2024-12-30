@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/landing/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Cuci Pakaian Anda Dengan
                                        Perawatan Terbaik</h1>
                                    <a href="javascript:void(0)" class="btn btn-primary py-sm-3 px-sm-4">Jelajahi Layanan Kami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="assets/landing/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Layanan Laundry Cepat dan
                                        Berkualitas</h1>
                                    <a href="javascript:void(0)" class="btn btn-primary py-sm-3 px-sm-4">Jelajahi Layanan Kami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Top Feature Start -->
    <div class="container-fluid top-feature py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-times text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Tanpa Biaya Tersembunyi</h4>
                                <span>Biaya laundry yang transparan tanpa tambahan yang tidak diketahui</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-users text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Tim Terlatih</h4>
                                <span>Tim ahli kami siap memberikan layanan laundry terbaik dengan hasil maksimal</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-phone text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Layanan 24/7</h4>
                                <span>Kami siap melayani Anda kapan saja, 24 jam sehari, 7 hari seminggu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Feature End -->


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
                    <p class="mb-4">Dengan pengalaman lebih dari 25 tahun, kami memberikan layanan laundry terbaik dengan
                        hasil yang memuaskan. Dari cuci, setrika, hingga dry cleaning, semuanya kami lakukan dengan kualitas
                        terbaik.</p>
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


    <!-- Facts Start -->
    <div class="container-fluid facts my-5 py-5" data-parallax="scroll" data-image-src="assets/landing/img/carousel-1.jpg">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">5000</h1>
                    <span class="fs-5 fw-semi-bold text-light">Pelanggan Puas</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">15000</h1>
                    <span class="fs-5 fw-semi-bold text-light">Pakaian Dicuci</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">50</h1>
                    <span class="fs-5 fw-semi-bold text-light">Tim Profesional</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">10</h1>
                    <span class="fs-5 fw-semi-bold text-light">Penghargaan Terima</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Mengapa Memilih Kami!</p>
                    <h1 class="display-5 mb-4">Beberapa Alasan Mengapa Orang Memilih Kami!</h1>
                    <p class="mb-4">Kami menyediakan layanan laundry terbaik dengan kualitas yang terjamin. Dari cuci
                        hingga setrika, kami selalu berusaha memberikan hasil terbaik untuk pakaian Anda.</p>
                    <a class="btn btn-primary py-3 px-4" href="javascript:void(0)">Jelajahi Layanan Kami</a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="text-center rounded py-5 px-4"
                                        style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                            style="width: 90px; height: 90px;">
                                            <i class="fa fa-check fa-3x text-primary"></i>
                                        </div>
                                        <h4 class="mb-0">100% Kepuasan Pelanggan</h4>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="text-center rounded py-5 px-4"
                                        style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                            style="width: 90px; height: 90px;">
                                            <i class="fa fa-users fa-3x text-primary"></i>
                                        </div>
                                        <h4 class="mb-0">Tim Profesional</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                    style="width: 90px; height: 90px;">
                                    <i class="fa fa-tools fa-3x text-primary"></i>
                                </div>
                                <h4 class="mb-0">Peralatan Modern</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Layanan Kami</p>
                <h1 class="display-5 mb-5">Layanan yang Kami Tawarkan untuk Anda</h1>
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

    <!-- Quote Start -->
    <div class="container-fluid quote my-5 py-5" data-parallax="scroll"
        data-image-src="assets/landing/img/carousel-2.jpg">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="bg-white rounded p-4 p-sm-5 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-5 text-center mb-5">Dapatkan Penawaran Gratis</h1>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="gname"
                                        placeholder="Nama Anda">
                                    <label for="gname">Nama Anda</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-light border-0" id="gmail"
                                        placeholder="Email Anda">
                                    <label for="gmail">Email Anda</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="cname"
                                        placeholder="Nama Layanan">
                                    <label for="cname">Jenis Layanan</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="cage"
                                        placeholder="Nomor Kontak">
                                    <label for="cage">Nomor Kontak</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-light border-0" placeholder="Tinggalkan pesan Anda di sini" id="message"
                                        style="height: 100px"></textarea>
                                    <label for="message">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary py-3 px-5" type="submit">Dapatkan Penawaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->

    <!-- Tim Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Tim Kami</p>
                <h1 class="display-5 mb-5">Anggota Tim yang Berdedikasi & Berpengalaman</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="assets/landing/img/carousel-1.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Doris Jordan</h4>
                            <p class="text-primary">Spesialis Pencucian Kering</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="assets/landing/img/carousel-2.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Johnny Ramirez</h4>
                            <p class="text-primary">Spesialis Laundry & Setrika</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="assets/landing/img/carousel-3.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Diana Wagner</h4>
                            <p class="text-primary">Manajer Laundry</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href="javascript:void(0)"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tim End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Testimoni</p>
                    <h1 class="display-5 mb-5">Apa Kata Pelanggan Tentang Kami!</h1>
                    <p class="mb-4">Kami memberikan pelayanan laundry terbaik dengan hasil yang memuaskan. Kami selalu
                        menjaga kualitas layanan agar pakaian Anda tetap bersih dan wangi.</p>
                    <a class="btn btn-primary py-3 px-4" href="javascript:void(0)">Lihat Selengkapnya</a>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item">
                            <img class="img-fluid rounded mb-3" src="assets/landing/img/carousel-1.jpg"
                                alt="">
                            <p class="fs-5">Pelayanan laundry yang cepat dan hasilnya sangat memuaskan. Pakaian saya
                                selalu kembali bersih dan wangi.</p>
                            <h4>Nama Pelanggan</h4>
                            <span>Profesional</span>
                        </div>
                        <div class="testimonial-item">
                            <img class="img-fluid rounded mb-3" src="assets/landing/img/carousel-2.jpg"
                                alt="">
                            <p class="fs-5">Saya sangat puas dengan layanan laundry ini. Pakaian saya tidak hanya bersih,
                                tetapi juga terasa segar.</p>
                            <h4>Nama Pelanggan</h4>
                            <span>Pengusaha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endSection

@section('scripts')
    {{-- Scripts --}}
@endsection
