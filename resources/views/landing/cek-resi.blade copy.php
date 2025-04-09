@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.css" />
    <link
        href="{{ asset('assets/landing/css/invoice.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/invoice.css'))) }}"
        rel="stylesheet">
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cek Resi</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    {{-- <div class="container-fluid"> --}}
        <div class="container">
            <!-- Bagian Judul -->
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Cek Resi</p>
                <h1 class="display-5 mb-5" style="font-size: 30px;">Cek Progress pesanan anda disini melalui nomor resi yang
                    anda miliki.</h1>
            </div>

            <!-- Form Cek Resi -->
            <div class="row justify-content-center g-4">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <input type="text" class="form-control" id="resiInput" placeholder="Masukkan Nomor Resi"
                                    style="max-width: 100%;">
                                <button type="button" class="btn btn-outline-primary mt-3 w-100" onclick="checkResi()">Cek
                                    Resi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar Resi -->
            <div class="row justify-content-center g-4 mt-5">
                <div id="resiList"></div>
                {{-- <div id="invoiceList"></div> --}}
            </div>
        </div>
@endSection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.min.js"></script>
    <link
        href="{{ asset('assets/landing/js/jspdf.min.js') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/js/jspdf.min.js'))) }}"
        rel="stylesheet">
    <script>
        async function checkResi() {
            const resiInput = document.getElementById('resiInput').value.trim();

            if (!resiInput) {
                alert('Masukkan nomor resi!');
                return;
            }

            try {
                const response = await fetch('/cek-resi/search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        resi: resiInput
                    }),
                });

                const result = await response.json();

                if (result.status === 'success') {
                    const data = result.data;

                    document.getElementById('resiList').innerHTML = `
                            // <h5 class="fw-bold mb-2">Search Result:</h5>
                            <div class="container padding-bottom-3x mb-4">
                                <div class="card mb-3 shadow" style="border: 0px;">
                                    <div class="p-4 text-center text-white text-lg rounded-top" style="background-image: linear-gradient(to bottom, #ff0000, #ff8100);">
                                        <span>Tracking Order No &nbsp; - &nbsp; </span><span class="text-medium fw-bold">${data.no_resi}</span>
                                    </div>
                                    <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary mb-2">
                                        <div class="w-100 text-center py-1 px-2">No Cust: <span class="text-medium badge mx-2"> ${data.no_cust}</span></div>
                                        <div class="w-100 text-center py-1 px-2">Nama Cust: <span class="text-medium badge mx-2"> ${data.nama_cust}</span></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                            <div class="step completed">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-check-circle"></i></div>
                                            </div>
                                            <h4 class="step-title">Proses Pembayaran</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-shopping-basket"></i></div>
                                            </div>
                                            <h4 class="step-title">Diterima</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-search"></i></div>
                                            </div>
                                            <h4 class="step-title">Proses Pencucian</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-tshirt"></i></div>
                                            </div>
                                            <h4 class="step-title">Pengeringan</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-store"></i></div>
                                            </div>
                                            <h4 class="step-title">Siap Diambil</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="fas fa-store"></i></div>
                                            </div>
                                            <h4 class="step-title">Selesai</h4>
                                        </div>
                                        </div>
                                        <div class="notes-section mt-4">
                                            <!-- Note for Step 1 -->
                                            <div class="note mb-3 active">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="fw-bold">Confirmed Order</h5>
                                                        <span class="text-muted">${data.updated_at}</span>
                                                        <p class="text-muted">Pesanan Anda telah diterima dan dikonfirmasi oleh sistem.</p>
                                                    </div>
                                                    <div>
                                                        <i class="fas fa-clock text-muted"></i> <!-- Icon Jam untuk Progress -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Note for Step 2 -->
                                            <div class="note mb-3">
                                                <h5 class="fw-bold">Processing Order</h5>
                                                <p class="text-muted">Pesanan sedang diproses di gudang kami.</p>
                                            </div>
                                            <!-- Note for Step 3 -->
                                            <div class="note mb-3">
                                                <h5 class="fw-bold">Quality Check</h5>
                                                <p class="text-muted">Barang sedang melalui pemeriksaan kualitas.</p>
                                            </div>
                                            <!-- Note for Step 4 -->
                                            <div class="note mb-3">
                                                <h5 class="fw-bold">Product Dispatched</h5>
                                                <p class="text-muted">Barang telah dikirim dan sedang dalam perjalanan ke alamat Anda.</p>
                                            </div>
                                            <!-- Note for Step 5 -->
                                            <div class="note">
                                                <h5 class="fw-bold">Product Delivered</h5>
                                                <p class="text-muted">Barang telah sampai di tujuan. Terima kasih telah berbelanja bersama kami!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                } else {
                    document.getElementById('resiList').innerHTML = `
                            <div class="alert alert-warning">
                                ${result.message}
                            </div>
                        `;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
