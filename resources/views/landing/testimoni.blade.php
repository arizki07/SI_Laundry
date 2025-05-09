@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-2/assets/css/faq-2.css">
@endsection

@section('content')
@include('components.alert')
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
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">

                        @if ($testimoni->isEmpty())
                            <div class="container text-center">
                                <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="col-lg-6">
                                        <p class="mb-4">Tidak ada data yang ditemukan</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($testimoni as $item)
                                <div class="card border-0 shadow-sm mb-4 p-4 rounded-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('assets/landing/img/favicon.png') }}"
                                            class="rounded-circle shadow-sm me-3" width="60" height="60" alt="Foto Pelanggan">
                                        <div>
                                            <h5 class="mb-1 fw-bold text-primary">
                                                {{ \App\Models\CustomerModel::where('no_hp', $item->no_hp_cust)->value('nama') ?? 'Pelanggan' }}
                                            </h5>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->rating)
                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                            @else
                                                <i class="bi bi-star text-warning fs-5"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <p class="fst-italic text-secondary border-start border-3 ps-3 mb-3">
                                        "{{ $item->komentar }}"
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-dark border">
                                        <i class="bi bi-upc-scan me-1"></i>
                                        Resi:
                                        <strong>
                                            @if (empty($item->no_resi))
                                                Unknown
                                            @else
                                                {{ substr($item->no_resi, 0, 8) . str_repeat('•', max(0, strlen($item->no_resi) - 8)) }}
                                            @endif
                                        </strong>
                                    </span>

                                        @if ($item->status == 1)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-slash-circle me-1"></i> Nonaktif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Penilaian Anda!</p>
                    <h1 class="display-5" style="font-size: 30px;">Beri kami feedback</h1>
                    <p class="mb-4">Feedback anda sangat berharga untuk kami!</p>
                    <form action="{{ route('post.rating') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="resi" placeholder="Subjek">
                                        <label for="subject">Kode Pemesanan</label>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3 mt-1">
                                    <div id="star-rating">
                                        <i class="bi bi-star-fill text-secondary fs-3" data-value="1"></i>
                                        <i class="bi bi-star-fill text-secondary fs-3" data-value="2"></i>
                                        <i class="bi bi-star-fill text-secondary fs-3" data-value="3"></i>
                                        <i class="bi bi-star-fill text-secondary fs-3" data-value="4"></i>
                                        <i class="bi bi-star-fill text-secondary fs-3" data-value="5"></i>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-add" value="4">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Tulis pesan Anda di sini" id="message" style="height: 100px"></textarea>
                                    <label for="message">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- SCRIPTS --}}
    <script>
        const stars = document.querySelectorAll('#star-rating i');
        const ratingInput = document.getElementById('rating-add');
        let lockedRating = 0;

        function highlightStars(rating) {
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'));
                if (value <= rating) {
                    star.classList.add('text-warning');
                    star.classList.remove('text-secondary');
                } else {
                    star.classList.add('text-secondary');
                    star.classList.remove('text-warning');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            lockedRating = 4;
            ratingInput.value = lockedRating;
            highlightStars(lockedRating);
        });

        stars.forEach(star => {
            const value = parseInt(star.getAttribute('data-value'));

            star.addEventListener('mouseover', () => {
                highlightStars(value);
            });

            star.addEventListener('mouseout', () => {
                highlightStars(lockedRating);
            });

            star.addEventListener('click', () => {
                lockedRating = value;
                ratingInput.value = value;
                highlightStars(value);
            });
        });
    </script>
@endsection
