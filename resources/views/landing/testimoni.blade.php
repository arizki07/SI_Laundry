@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-2/assets/css/faq-2.css">
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Testimoni</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Testimonial</p>
                    <h1 class="display-5 mb-5">Apa Kata Klien Kami Tentang Kami!</h1>
                    <p class="mb-4">Kami selalu berusaha memberikan pelayanan terbaik. Klien kami merasa puas dengan
                        layanan laundry yang cepat, bersih, dan terpercaya. Berikut adalah beberapa testimoni dari mereka
                        yang telah merasakan langsung pengalaman menggunakan layanan Indah Laundry.</p>
                    <a class="btn btn-primary py-3 px-4" href="{{ route('landing.bantuan') }}">Hubungi Kami</a>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">

                        @foreach ($testimoni as $item)
                            <div class="testimonial-item">
                                <img class="img-fluid rounded mb-3"
                                    src="{{ asset('assets/landing/img/testimonial-1.jpg') }}" alt="">
                                <p class="fs-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $item->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </p>
                                <h4>
                                    @foreach (\App\models\CustomerModel::all() as $cust)
                                        @if ($cust->no_hp == $item->no_hp_cust)
                                            {{ $cust->nama }}
                                        @endif
                                    @endforeach
                                </h4>
                                <span>{{ $item->komentar }}</span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- SCRIPTS --}}
@endsection
