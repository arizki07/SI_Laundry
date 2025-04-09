@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.css" />
    <link
        href="{{ asset('assets/landing/css/invoice.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/invoice.css'))) }}"
        rel="stylesheet">

    <style>
        .note.active {
            border-left: 4px solid #3758F9;
            background-color: #f0f4ff;
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .note .fas {
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Cek Kode Pemesanan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cek Kode Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    {{-- <div class="container-fluid"> --}}
    <div class="container">
        <!-- Bagian Judul -->
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-bold text-primary">Cek Kode Pemesanan</p>
            <h1 class="display-5 mb-5" style="font-size: 22px;">Cek Progress pesanan anda disini melalui nomor resi yang
                anda miliki.</h1>
        </div>

        <!-- Form Cek Resi -->
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                {{-- <form action="" method="POST"> --}}
                    <form onsubmit="checkResi(); return false;" method="POST">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <input type="text" class="form-control" id="resiInput" placeholder="Masukkan Kode Pemesanan Anda"
                                style="max-width: 100%;">
                            <button type="button" class="btn btn-outline-primary mt-3 w-100" onclick="checkResi()">Cek
                                Kode Pemesanan</button>
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

                    const steps = [{
                            title: "Proses Pembayaran",
                            icon: "fas fa-credit-card"
                        },
                        {
                            title: "Diterima",
                            icon: "fas fa-inbox"
                        },
                        {
                            title: "Proses Pencucian",
                            icon: "fas fa-tint"
                        },
                        {
                            title: "Pengeringan",
                            icon: "fas fa-wind"
                        },
                        {
                            title: "Siap Ambil",
                            icon: "fas fa-box-open"
                        },
                        {
                            title: "Selesai",
                            icon: "fas fa-check-circle"
                        }
                    ];

                    let lastStatusIndex = steps.findIndex(
    step => step.title.toLowerCase() === data.status.toLowerCase()
);

// Jika status tidak ditemukan, tambahkan di paling kiri (index 0)
if (lastStatusIndex === -1) {
    steps.unshift({
        title: data.status,
        icon: "fas fa-info-circle" // default icon
    });
    lastStatusIndex = 0;
}

let stepsHTML = '';
steps.forEach((step, index) => {
    const isCompleted = index <= lastStatusIndex ? 'completed' : '';
    stepsHTML += `
        <div class="step ${isCompleted}">
            <div class="step-icon-wrap">
                <div class="step-icon"><i class="${step.icon}"></i></div>
            </div>
            <h4 class="step-title">${step.title}</h4>
        </div>
    `;
});

                    // Notes data sesuai urutan
                    const notes = [{
                            title: "Proses Pembayaran",
                            statusKey: "proses pembayaran"
                        },
                        {
                            title: "Diterima",
                            statusKey: "diterima"
                        },
                        {
                            title: "Proses Pencucian",
                            statusKey: "proses pencucian"
                        },
                        {
                            title: "Pengeringan",
                            statusKey: "pengeringan"
                        },
                        {
                            title: "Siap Diambil",
                            statusKey: "siap ambil"
                        },
                        {
                            title: "Selesai",
                            statusKey: "selesai"
                        }
                    ];

                    const activeNoteIndex = notes.findIndex(note => note.statusKey === data.status.toLowerCase());

                    const historyMap = {};
                    const stepKeys = notes.map(n => n.statusKey);
                    let reachedIndex = stepKeys.indexOf(data.status.toLowerCase());

                    data.history.forEach(h => {
                        const key = h.status.toLowerCase();
                        const idx = stepKeys.indexOf(key);
                        if (idx !== -1 && idx <= reachedIndex) {
                            historyMap[key] = {
                                desc: h.catatan || "",
                                timestamp: h.created_at || ""
                            };
                        }
                    });

                    let notesHTML = '';
                    notes.forEach((note, index) => {
                        const status = note.statusKey;
                        const isActive = index === activeNoteIndex;
                        const isCompleted = index < activeNoteIndex;

                        const historyData = historyMap[status] || {};
                        const desc = historyData.desc || "-";
                        const timestamp = historyData.timestamp || "";

                        let icon = "";
                        if (isCompleted || (data.status.toLowerCase() === "selesai" && status === "selesai")) {
                            icon = '<i class="fas fa-check text-success ms-2"></i>';
                        } else if (isActive) {
                            icon = '<i class="fas fa-clock text-primary ms-2"></i>';
                        }

                        notesHTML += `
                            <div class="note mb-3 ${isActive ? 'active' : ''}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold">${note.title}</h5>
                                        ${timestamp !== "" ? `<span class="text-muted">${timestamp}</span>` : ''}
                                        <p class="text-muted">${desc}</p>
                                    </div>
                                    ${icon}
                                </div>
                            </div>
                        `;
                    });

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
                                            ${stepsHTML}
                                        </div>
                                        <div class="notes-section mt-4">
                                            ${notesHTML}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                } else {
                    document.getElementById('resiList').innerHTML = `
                            <div class="alert alert-info">
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
