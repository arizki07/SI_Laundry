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
                                    <form method="POST" action="{{ route('update.sales', $sales->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-5">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Customer</label>
                                                    <select class="form-select" name="customer_id">
                                                        <option disabled>--Pilih Customer--</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}"
                                                                {{ $sales->customer_id == $customer->id ? 'selected' : '' }}>
                                                                {{ $customer->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">File Bukti</label>
                                                    <input type="file" class="form-control" name="file_bukti">
                                                    @if ($sales->file_bukti)
                                                        <a href="{{ asset('storage/sales/bukti/' . $sales->file_bukti) }}"
                                                            target="_blank">Lihat File</a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Metode Pembayaran</label>
                                                    <select class="form-select" name="metode_pembayaran">
                                                        <option disabled>--Pilih Metode Pembayaran--</option>
                                                        <option value="cash"
                                                            {{ $sales->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash
                                                        </option>
                                                        <option value="transfer"
                                                            {{ $sales->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                                            Transfer</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Status Pembayaran</label>
                                                    <select class="form-select" name="status_pembayaran">
                                                        <option disabled>--Pilih Status Pembayaran--</option>
                                                        @foreach ($statuses as $status)
                                                            <option value="{{ $status->nama }}"
                                                                {{ $sales->status_pembayaran == $status->nama ? 'selected' : '' }}>
                                                                {{ ucfirst($status->nama) }}
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
                                                    <button type="button" id="add-item-button" class="btn btn-success"><i
                                                            class="fa-solid fa-cart-plus"></i> Add Item</button>
                                                </div>

                                                <div id="sales-items-container">
                                                    @foreach ($sales->items as $item)
                                                        <div class="sales-item row mb-3">
                                                            <div
                                                                class="col-md-1 d-flex justify-content-center align-items-center">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-remove-item">X</button>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Product</label>
                                                                <select class="form-select product-select"
                                                                    name="products[]">
                                                                    <option disabled>--Pilih Produk--</option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product->id }}"
                                                                            data-price="{{ $product->harga }}"
                                                                            {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                                            {{ $product->nama_produk }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label">Quantity</label>
                                                                <input type="number" class="form-control qty-input"
                                                                    name="qty[]" min="0.1" step="0.1"
                                                                    value="{{ $item->qty }}">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" class="form-control price-input"
                                                                    name="harga_per_qty[]"
                                                                    value="{{ $item->harga_per_qty }}" readonly>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label">Total</label>
                                                                <input type="number" class="form-control total-input"
                                                                    name="total[]" value="{{ $item->total }}" readonly>
                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <input type="checkbox" class="round-up-checkbox"
                                                                    name="round_up[]" value="1">
                                                                <label>Bulatkan ke atas (contoh: 4.5 menjadi 5)</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-xl-12 text-end">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa-solid fa-check"></i> Update
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

            container.addEventListener('change', function(event) {
                if (event.target.classList.contains('product-select')) {
                    const row = event.target.closest('.sales-item');
                    const selectedOption = event.target.selectedOptions[0];
                    const price = selectedOption.getAttribute('data-price') || 0;

                    row.querySelector('.price-input').value = price;
                    const qty = row.querySelector('.qty-input').value || 0;
                    row.querySelector('.total-input').value = price * qty;
                }
            });

            container.addEventListener('input', function(event) {
                if (event.target.classList.contains('qty-input')) {
                    const row = event.target.closest('.sales-item');
                    const price = row.querySelector('.price-input').value || 0;
                    const qty = event.target.value || 0;
                    row.querySelector('.total-input').value = price * qty;
                }
            });

            document.getElementById('add-item-button').addEventListener('click', function() {
                const itemTemplate = container.querySelector('.sales-item').cloneNode(true);
                itemTemplate.querySelectorAll('input').forEach(input => input.value = '');
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
