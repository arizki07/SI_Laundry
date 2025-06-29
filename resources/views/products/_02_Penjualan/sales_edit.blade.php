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
                                                    {{-- Select disabled hanya untuk tampilan --}}
                                                    <select class="form-select" disabled>
                                                        <option disabled>--Pilih Customer--</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}"
                                                                {{ $sales->customer_id == $customer->id ? 'selected' : '' }}>
                                                                {{ $customer->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    {{-- Hidden input untuk tetap mengirim customer_id --}}
                                                    <input type="hidden" name="customer_id"
                                                        value="{{ $sales->customer_id }}">
                                                </div>


                                                {{-- <div class="mb-3">
                                                    <label class="form-label">File Bukti</label>
                                                    <input type="file" class="form-control" name="file_bukti">
                                                    @if ($sales->file_bukti)
                                                        <a href="{{ asset('storage/sales/bukti/' . $sales->file_bukti) }}"
                                                            target="_blank">Lihat File</a>
                                                    @endif
                                                </div> --}}
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Metode Pembayaran</label>
                                                    {{-- Select hanya untuk tampilan (disabled) --}}
                                                    <select class="form-select" disabled>
                                                        <option disabled>--Pilih Metode Pembayaran--</option>
                                                        <option value="cash"
                                                            {{ $sales->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                                            Cash
                                                        </option>
                                                    </select>

                                                    {{-- Hidden input untuk tetap mengirim nilai metode pembayaran --}}
                                                    <input type="hidden" name="metode_pembayaran"
                                                        value="{{ $sales->metode_pembayaran }}">
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">Status Pembayaran</label>
                                                    <select class="form-select" name="status_pembayaran"
                                                        id="status_pembayaran">
                                                        <option disabled>--Pilih Status Pembayaran--</option>
                                                        <option value="pending"
                                                            {{ $sales->status_pembayaran == 'pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                        <option value="lunas"
                                                            {{ $sales->status_pembayaran == 'lunas' ? 'selected' : '' }}>
                                                            Lunas</option>
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
                                                    @foreach ($sales->items as $index => $item)
                                                        <div class="sales-item row mb-3" style="min-width: 600px;">
                                                            <div
                                                                class="col-md-1 d-flex justify-content-center align-items-center">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-remove-item">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
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

                                                            <div class="col-md-2">
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

                                                            <div
                                                                class="col-md-2 d-flex justify-content-start align-items-center">
                                                                <input type="hidden"
                                                                    name="round_up[{{ $index }}]" value="0">
                                                                <input type="checkbox" class="round-up-checkbox"
                                                                    name="round_up[{{ $index }}]" value="1"
                                                                    {{ $item->round_up ? 'checked' : '' }}>
                                                                <label class="ms-2">Bulatkan</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3 offset-md-9 mb-2">
                                                        <label class="form-label fw-bold">Total</label>
                                                        <input type="text" class="form-control text-end"
                                                            id="total" name="total_two" readonly
                                                            value="{{ $sales->total }}">
                                                    </div>
                                                    <div class="col-md-3 offset-md-9 mb-2">
                                                        <label class="form-label fw-bold">Diskon (Rp)</label>
                                                        <input type="text" class="form-control text-end"
                                                            id="diskon" name="disc" value="{{ $sales->disc }}">
                                                    </div>
                                                    <div class="col-md-3 offset-md-9">
                                                        <label class="form-label fw-bold">Subtotal</label>
                                                        <input type="text" class="form-control text-end"
                                                            id="subtotal" name="subtotal" readonly
                                                            value="{{ $sales->subtotal }}">
                                                    </div>
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
            const totalField = document.getElementById('total');
            const diskonInput = document.getElementById('diskon');
            const subtotalField = document.getElementById('subtotal');

            // Fungsi untuk menghitung total per baris
            const calculateTotal = (row) => {
                const priceInput = row.querySelector('.price-input');
                const qtyInput = row.querySelector('.qty-input');
                const totalInput = row.querySelector('.total-input');
                const roundUpCheckbox = row.querySelector('.round-up-checkbox');

                const price = parseFloat(priceInput.value) || 0;
                let qty = parseFloat(qtyInput.value) || 0;

                // Pembulatan qty berdasarkan checkbox
                if (roundUpCheckbox.checked) {
                    qty = (Math.ceil(qty) % 2 === 0) ? Math.ceil(qty) : Math.ceil(qty + 1);
                } else {
                    qty = Math.floor(qty);
                }

                totalInput.value = (qty * price).toFixed(2);
                calculateGrandTotal();
            };

            // Fungsi untuk menghitung grand total
            const calculateGrandTotal = () => {
                let total = 0;
                document.querySelectorAll('.total-input').forEach(input => {
                    const val = parseFloat(input.value);
                    if (!isNaN(val)) {
                        total += val;
                    }
                });

                totalField.value = total.toFixed(2);

                // Ambil nilai diskon
                let diskon = parseFloat(diskonInput.value.replace(/[^0-9.-]+/g, '')) || 0;

                const subtotal = total - diskon;
                subtotalField.value = subtotal.toFixed(2);
            };

            // Event handler saat memilih produk
            container.addEventListener('change', async function(event) {
                const row = event.target.closest('.sales-item');

                if (event.target.classList.contains('product-select')) {
                    const selectedOption = event.target.selectedOptions[0];
                    const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    row.querySelector('.price-input').value = price;
                    calculateTotal(row);
                }

                // Checkbox bulatkan
                if (event.target.classList.contains('round-up-checkbox')) {
                    const checkbox = event.target;

                    if (checkbox.checked) {
                        const result = await Swal.fire({
                            title: 'Masukkan jumlah pembulatan',
                            input: 'number',
                            inputLabel: 'Jumlah pembulatan (total)',
                            inputPlaceholder: 'Contoh: 15000',
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Batal',
                            inputValidator: (value) => {
                                if (!value || isNaN(value) || value <= 0) {
                                    return 'Masukkan angka valid lebih dari 0!';
                                }
                            }
                        });

                        if (result.isConfirmed) {
                            const pembulatan = parseFloat(result.value);
                            row.querySelector('.total-input').value = pembulatan.toFixed(2);

                            row.querySelector('.qty-input').readOnly = true;
                            row.querySelector('.price-input').readOnly = true;

                            calculateGrandTotal();
                        } else {
                            checkbox.checked = false;
                        }
                    } else {
                        row.querySelector('.qty-input').readOnly = false;
                        row.querySelector('.price-input').readOnly = false;
                        calculateTotal(row);
                    }
                }
            });

            // Event handler saat qty atau harga input berubah
            container.addEventListener('input', function(event) {
                if (event.target.classList.contains('qty-input') || event.target.classList.contains(
                        'price-input')) {
                    const row = event.target.closest('.sales-item');
                    calculateTotal(row);
                }
            });

            // Diskon input berubah
            diskonInput.addEventListener('input', function() {
                calculateGrandTotal();
            });

            // Menambah item
            document.getElementById('add-item-button').addEventListener('click', function() {
                const itemTemplate = container.querySelector('.sales-item').cloneNode(true);
                const itemCount = container.querySelectorAll('.sales-item').length;

                itemTemplate.querySelectorAll('input').forEach(input => {
                    if (input.type === 'checkbox') {
                        input.checked = false;
                    } else if (input.type === 'hidden') {
                        input.value = '0';
                    } else {
                        input.value = '';
                    }
                    input.readOnly = false;
                });

                itemTemplate.querySelector('.product-select').selectedIndex = 0;
                itemTemplate.querySelector('.price-input').readOnly = true;
                itemTemplate.querySelector('.total-input').readOnly = true;

                itemTemplate.querySelectorAll('[name^="round_up"]').forEach((input) => {
                    input.name = `round_up[${itemCount}]`;
                });

                container.appendChild(itemTemplate);
            });

            // Menghapus item
            container.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-remove-item')) {
                    const row = event.target.closest('.sales-item');
                    if (container.querySelectorAll('.sales-item').length > 1) {
                        row.remove();
                        calculateGrandTotal();
                    } else {
                        alert('Minimal satu item harus ada.');
                    }
                }
            });

            // Hitung awal
            calculateGrandTotal();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusPembayaranSelect = document.querySelector('select[name="status_pembayaran"]');
            const pembayaranFieldContainer = document.createElement('div');

            pembayaranFieldContainer.classList.add('mb-3');
            pembayaranFieldContainer.innerHTML = `
            <label class="form-label">Jumlah DP</label>
            <input type="number" class="form-control" name="pembayaran" id="pembayaran" min="0" step="0.01">
            <small id="dp-warning" class="text-danger" style="display: none;">
                DP tidak boleh lebih besar dari total pembayaran!
            </small>
        `;

            pembayaranFieldContainer.style.display = 'none';
            statusPembayaranSelect.closest('.mb-3').after(pembayaranFieldContainer);

            const pembayaranInput = document.getElementById('pembayaran');
            const dpWarning = document.getElementById('dp-warning');
            const totalHargaInput = document.getElementById('total_harga');

            function updateDPField() {
                let totalHarga = parseFloat(totalHargaInput.value) || 0;

                if (statusPembayaranSelect.value === 'dp') {
                    pembayaranFieldContainer.style.display = 'block';
                    pembayaranInput.setAttribute('max', totalHarga);
                } else {
                    pembayaranFieldContainer.style.display = 'none';
                    pembayaranInput.value = '';
                    dpWarning.style.display = 'none';
                }
            }

            function validateDP() {
                let totalHarga = parseFloat(totalHargaInput.value) || 0;
                let dpValue = parseFloat(pembayaranInput.value) || 0;

                if (dpValue > totalHarga) {
                    dpWarning.style.display = 'block';
                } else {
                    dpWarning.style.display = 'none';
                }
            }

            statusPembayaranSelect.addEventListener('change', updateDPField);
            pembayaranInput.addEventListener('input', validateDP);

            updateDPField();
        });
    </script>
@endsection
