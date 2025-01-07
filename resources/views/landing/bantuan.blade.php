@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-2/assets/css/faq-2.css">
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Bantuan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Bagian Judul -->
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Bantuan</p>
                <h1 class="display-5 mb-5" style="font-size: 30px;">Temukan jawaban atas pertanyaan umum atau masalah yang
                    Anda hadapi di sini.</h1>
            </div>

            <div class="row justify-content-center align-items-center g-4 mt-5">
                <div class="col-12 col-lg-10">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-11">
                            @if ($faqs->isEmpty())
                                <div class="text-center mt-5">
                                    <h5 class="text-muted">Belum ada data FAQs yang tersedia.</h5>
                                </div>
                            @else
                                <div class="accordion accordion-flush" id="accordionExample">
                                    @foreach ($faqs as $item)
                                        <div class="accordion-item mb-4 shadow-sm">
                                            <h2 class="accordion-header" id="heading{{ $item->id }}">
                                                <button class="accordion-button bg-transparent fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                                    {{ $item->judul }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $item->id }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>{{ $item->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- SCRIPTS --}}
@endsection
