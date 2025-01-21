@extends('layouts.app')
@section('content')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-body-scan">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                    <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                    <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                    <path d="M12 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    <path d="M10 17v-1a2 2 0 1 1 4 0v1" />
                                    <path d="M8 10c.666 .666 1.334 1 2 1h4c.666 0 1.334 -.334 2 -1" />
                                    <path d="M12 11v3" />
                                </svg>
                                {{ $judul }}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-solid fa-virus"></i> {{ $judul }}</a></li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-lg-12">
                            <div class="card card-xl border-primary shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-cube-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M21 12.5v-4.509a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.007c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0" />
                                            <path d="M12 22v-10" />
                                            <path d="M12 12l8.73 -5.04" />
                                            <path d="M3.27 6.96l8.73 5.04" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row g-5">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Customer</label>
                                                    <select class="form-select" name="customer_id">
                                                        <option selected disabled>--Pilih Customer--</option>
                                                        @foreach ($cust as $cus)
                                                            <option value="{{ $cus->id }}">{{ $cus->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Metode Pembayaran</label>
                                                    <select class="form-select" name="metode_pembayaran">
                                                        <option selected disabled>--Pilih Metode Pembayaran--</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">File Bukti</label>
                                                    <input type="file" class="form-control" name="file_bukti">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Status Pembayaran</label>
                                                    <select class="form-select" name="status_pembayaran">
                                                        <option selected disabled>--Pilih Status Pembayaran--</option>
                                                        @foreach ($status as $stat)
                                                            <option value="{{ $stat->nama }}">{{ ucfirst($stat->nama) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row g-5">
                                            <div class="col-xl-12">
                                                <div class="text-end">
                                                    <button type="button" id="add-item-button" class="btn btn-success">
                                                        <i class="fa-solid fa-cart-plus"></i> Add Item
                                                    </button>
                                                </div>
                                                <div id="sales-items-container" style="overflow-x: auto;">
                                                    <div class="sales-item row mb-3" style="min-width: 600px;">
                                                        <!-- Hapus button di sebelah kiri produk -->
                                                        <div
                                                            class="col-md-1 d-flex justify-content-center align-items-center">
                                                            <button type="button" class="btn btn-danger btn-remove-item">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label">Product</label>
                                                            <select class="form-select product-select" name="products[]">
                                                                <option selected disabled>--Pilih Produk--</option>
                                                                @foreach ($product as $pro)
                                                                    <option value="{{ $pro->id }}"
                                                                        data-price="{{ $pro->harga }}">
                                                                        {{ $pro->nama_produk }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label class="form-label">Quantity</label>
                                                            <input type="number" class="form-control qty-input"
                                                                name="qty[]" min="1" step="0.1"
                                                                value="1">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label class="form-label">Price</label>
                                                            <input type="number" class="form-control price-input"
                                                                name="harga_per_qty[]" readonly>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label class="form-label">Total</label>
                                                            <input type="number" class="form-control total-input"
                                                                name="total[]" readonly>
                                                        </div>

                                                        <!-- Checkbox Bulatkan ke atas di sebelah kanan Total -->
                                                        <div
                                                            class="col-md-2 d-flex justify-content-start align-items-center">
                                                            <input type="checkbox" class="round-up-checkbox"
                                                                name="round_up[]" value="1">
                                                            <label>Bulatkan</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-xl-12 text-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa-solid fa-check"></i> Simpan
                                                </button>
                                                <a href="{{ route('sales.index') }}" class="btn btn-danger ms-2">
                                                    <i class="fa-solid fa-arrow-left"></i> Kembali
                                                </a>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('sales-items-container');

            const calculateTotal = (row) => {
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                let qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const roundUp = row.querySelector('.round-up-checkbox').checked;

                if (roundUp) {
                    qty = (Math.ceil(qty) % 2 === 0) ? Math.ceil(qty) : Math.ceil(qty + 1);
                } else {
                    qty = Math.floor(qty);
                }

                row.querySelector('.total-input').value = (qty * price).toFixed(2);
            };

            container.addEventListener('change', function(event) {
                if (event.target.classList.contains('product-select')) {
                    const row = event.target.closest('.sales-item');
                    const selectedOption = event.target.selectedOptions[0];
                    const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;

                    row.querySelector('.price-input').value = price;
                    calculateTotal(row);
                }

                if (event.target.classList.contains('round-up-checkbox')) {
                    const row = event.target.closest('.sales-item');
                    calculateTotal(row);
                }
            });

            container.addEventListener('input', function(event) {
                if (event.target.classList.contains('qty-input')) {
                    const row = event.target.closest('.sales-item');
                    calculateTotal(row);
                }
            });

            document.getElementById('add-item-button').addEventListener('click', function() {
                const itemTemplate = container.querySelector('.sales-item').cloneNode(true);

                itemTemplate.querySelectorAll('input').forEach(input => {
                    input.value = '';
                    if (input.type === 'checkbox') input.checked = false;
                });
                itemTemplate.querySelector('.product-select').selectedIndex = 0;

                container.appendChild(itemTemplate);
            });

            container.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-remove-item')) {
                    const row = event.target.closest('.sales-item');
                    if (container.querySelectorAll('.sales-item').length > 1) {
                        row.remove();
                    } else {
                        alert('At least one item is required.');
                    }
                }
            });
        });
    </script>
@endsection
