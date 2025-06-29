@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Keuangan</h3>
            </div>
            <div class="card-body">
                <form id="form-laporan" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="tanggal_sampai" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="hasil-laporan" class="mt-4"></div>
        <form id="export-pdf-form" method="GET" action="{{ route('report.pdf') }}" target="_blank" style="display: none;">
            <input type="hidden" name="tanggal_mulai">
            <input type="hidden" name="tanggal_sampai">
        </form>
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-detail-body">
        {{-- Detail akan dimuat di sini --}}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#form-laporan').on('submit', function(e) {
        e.preventDefault();
        const data = $(this).serialize();

        $.ajax({
            url: '{{ route("report.check") }}',
            method: 'GET',
            data: data,
            success: function(res) {
                $('#hasil-laporan').html(`
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hasil Laporan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Jumlah Transaksi -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted mb-2">Jumlah Transaksi Pemasukan</h5>
                                            <h3 class="fw-bold text-primary">${res.jumlahPemasukan}</h3>
                                            <button class="btn btn-outline-primary btn-sm mt-2" id="btn-pemasukan-detail">
                                                <i class="ti ti-list-details me-1"></i> Lihat Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted mb-2">Jumlah Transaksi Pengeluaran</h5>
                                            <h3 class="fw-bold text-danger">${res.jumlahPengeluaran}</h3>
                                            <button class="btn btn-outline-danger btn-sm mt-2" id="btn-pengeluaran-detail">
                                                <i class="ti ti-list-details me-1"></i> Lihat Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Uang -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm bg-primary-lt">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted mb-2">Total Pemasukan</h5>
                                            <h3 class="fw-bold text-primary">Rp${res.totalPemasukan}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm bg-danger-lt">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted mb-2">Total Pengeluaran</h5>
                                            <h3 class="fw-bold text-danger">Rp${res.totalPengeluaran}</h3>
                                        </div>
                                    </div>
                                </div>

                                <!-- Keuntungan dan Kerugian -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm bg-success-lt">
                                        <div class="card-body">
                                            <h5 class="card-title">Keuntungan</h5>
                                            <h3 class="fw-bold text-success">Rp${res.keuntungan}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm bg-danger-lt">
                                        <div class="card-body">
                                            <h5 class="card-title">Kerugian</h5>
                                            <h3 class="fw-bold text-danger">Rp${res.kerugian}</h3>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Akhir -->
                                <div class="col-12">
                                    <div class="card shadow-sm border border-blue">
                                        <div class="card-body text-center">
                                            <h4 class="fw-bold text-blue">Total Akhir</h4>
                                            <p class="fs-3 fw-bold mb-0">Rp${res.totalAkhir}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button id="export-pdf" class="btn btn-outline-red">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg> Export PDF
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            },
            error: function(err) {
                alert('Terjadi kesalahan! Periksa data input.');
            }
        });
    });

    // Detail Pemasukan
    $(document).on('click', '#btn-pemasukan-detail', function() {
        const tanggalMulai = $('[name="tanggal_mulai"]').val();
        const tanggalSampai = $('[name="tanggal_sampai"]').val();

        $.get("{{ route('report.detail.pemasukan') }}", {
            tanggal_mulai: tanggalMulai,
            tanggal_sampai: tanggalSampai
        }, function(response) {
            $('#modal-detail .modal-title').text('Detail Pemasukan');
            $('#modal-detail-body').html(response);
            new bootstrap.Modal(document.getElementById('modal-detail')).show();
        });
    });

    // Detail Pengeluaran
    $(document).on('click', '#btn-pengeluaran-detail', function() {
        const tanggalMulai = $('[name="tanggal_mulai"]').val();
        const tanggalSampai = $('[name="tanggal_sampai"]').val();

        $.get("{{ route('report.detail.pengeluaran') }}", {
            tanggal_mulai: tanggalMulai,
            tanggal_sampai: tanggalSampai
        }, function(response) {
            $('#modal-detail .modal-title').text('Detail Pengeluaran');
            $('#modal-detail-body').html(response);
            new bootstrap.Modal(document.getElementById('modal-detail')).show();
        });
    });

    // Export PDF
    $(document).on('click', '#export-pdf', function () {
        const tanggalMulai = $('[name="tanggal_mulai"]').val();
        const tanggalSampai = $('[name="tanggal_sampai"]').val();

        if (!tanggalMulai || !tanggalSampai) {
            alert('Isi tanggal dahulu!');
            return;
        }

        $('#export-pdf-form [name="tanggal_mulai"]').val(tanggalMulai);
        $('#export-pdf-form [name="tanggal_sampai"]').val(tanggalSampai);
        $('#export-pdf-form').submit();
    });

</script>
@endsection
