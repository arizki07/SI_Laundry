@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('scripts')
    {{-- Scripts --}}
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

                @if ($produk->isEmpty())
                    <div class="container text-center">
                        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                            <div class="col-lg-6">
                                <p class="mb-4">Tidak ada data yang ditemukan</p>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($produk as $item)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item rounded d-flex h-100">
                                <div class="service-img rounded">
                                    <img class="img-fluid" src="{{ asset('storage/produk/' . $item->foto_produk) }}"
                                        alt="{{ $item->nama_produk }}">
                                </div>
                                <div class="service-text rounded p-5">
                                    <div class="btn-square rounded-circle mx-auto mb-3 overflow-hidden"
                                        style="width: 100px; height: 100px;">
                                        <img class="img-fluid w-100 h-100"
                                            src="{{ asset('storage/produk/' . $item->foto_produk) }}" alt="Ikon"
                                            style="object-fit: cover;">
                                    </div>
                                    <h4 class="mb-3">{{ $item->nama_produk }}</h4>
                                    <p class="mb-4">{{ $item->deskripsi }}</p>
                                    {{-- <a class="btn btn-sm" href="{{ route('login') }}"><i
                                            class="fas fa-plus text-primary me-2"></i>Cek Layanan</a> --}}
                                    <a href="#" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-detail{{ $item->id }}">
                                        <i class="fas fa-search text-primary me-2"></i>Cek Layanan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-detail{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top-4">
                                        <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail Produk</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-4">
                                        <div class="col-md-6">
                                            <img src="{{ asset('storage/produk/' . $item->foto_produk) }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded-3">
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="mb-2">{{ $item->nama_produk }}</h4>
                                            <span class="badge bg-secondary mb-3">{{ ucfirst($item->category) }} - {{ ucfirst($item->type) }}</span>
                                            <p class="mb-3">{{ $item->deskripsi }}</p>
                                            <h5 class="text-primary mb-0">Rp {{ number_format($item->harga, 0, ',', '.') }} / {{ $item->type }}</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endSection
