@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('content')
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
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Syarat & Ketentuan</p>
                <h1 class="display-5 mb-5" style="font-size: 30px;">Ketentuan Layanan Laundry yang Perlu Anda Ketahui</h1>
            </div>            
            <div class="row gx-0">
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-cogs text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Layanan</h4>
                                <span>Kami menyediakan layanan laundry dengan pencucian, pengeringan, dan penyetrikaan sesuai standar. Layanan meliputi laundry kiloan, satuan, atau dry cleaning.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.2s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-clock text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Waktu Penyelesaian</h4>
                                <span>Waktu penyelesaian tergantung jenis layanan. Perubahan waktu akan diinformasikan kepada pelanggan jika diperlukan.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-truck text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Pengambilan & Pengantaran</h4>
                                <span>Pengambilan dan pengantaran dilakukan sesuai jadwal yang disepakati. Pelanggan bertanggung jawab memastikan informasi yang benar.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.4s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-exclamation-circle text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Barang Hilang atau Rusak</h4>
                                <span>Kami tidak bertanggung jawab atas barang rusak sebelum proses laundry. Penggantian maksimal 10x biaya laundry jika hilang/rusak karena kelalaian kami.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-ban text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Barang Tidak Diizinkan</h4>
                                <span>Barang berbahaya, mudah terbakar, atau bernilai tinggi tidak diperbolehkan. Jika ditemukan, barang dikembalikan tanpa proses.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.6s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-money-bill-wave text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Pembayaran</h4>
                                <span>Pembayaran dilakukan setelah layanan selesai atau sesuai kesepakatan. Kami menerima metode pembayaran tunai atau transfer.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.7s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-times-circle text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Kebijakan Pembatalan</h4>
                                <span>Pembatalan dapat dilakukan sebelum proses dimulai. Jika setelah proses dimulai, biaya tetap dikenakan.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.8s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-lock text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Kebijakan Privasi</h4>
                                <span>Data pelanggan dijaga kerahasiaannya dan tidak akan disebarluaskan tanpa izin pelanggan.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="0.9s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-sync text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Perubahan Syarat & Ketentuan</h4>
                                <span>Kami berhak mengubah syarat dan ketentuan kapan saja. Versi terbaru dapat ditemukan di website kami.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="1.0s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-shield-alt text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Keamanan Barang</h4>
                                <span>Kami menjaga keamanan barang pelanggan dengan standar prosedur yang ketat selama proses laundry.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="1.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-thumbs-up text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Garansi Kepuasan</h4>
                                <span>Jika pelanggan merasa tidak puas, kami siap mengevaluasi ulang hasil laundry sesuai keluhan yang diajukan.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-2" data-wow-delay="1.2s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-info-circle text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Bantuan Pelanggan</h4>
                                <span>Tim layanan pelanggan kami siap membantu dan memberikan informasi terkait layanan laundry.</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <div class="container-fluid facts my-5 py-5" data-parallax="scroll" data-image-src="assets/landing/img/carousel-1.jpg">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Happy Clients</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Garden Complated</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Dedicated Staff</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Awards Achieved</span>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- Scripts --}}
@endsection
