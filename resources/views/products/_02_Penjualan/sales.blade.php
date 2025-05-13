@extends('layouts.app')
@section('styles')
    <link
        href="{{ asset('assets/landing/css/invoice.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/invoice.css'))) }}"
        rel="stylesheet">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice_wrapper,
            #invoice_wrapper * {
                visibility: visible;
            }

            #invoice_wrapper {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: white;
            }
        }
    </style>
@endsection
@section('content')
    @include('shared.table')
@endsection

@section('modals')
    @foreach ($sales as $item)
        <div class="modal modal-blur fade" id="modal-view{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header bg-blue-lt">
                        <h5 class="modal-title text-blue">Detail Sales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="invoice-1 invoice-content" style="background-color: white;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="invoice-inner clearfix shadow">
                                            <div class="invoice-info clearfix" id="invoice_wrapper_{{ $item->id }}">
                                                <div class="invoice-headar">
                                                    <div class="row g-0">
                                                        <div class="col-sm-6">
                                                            <div class="invoice-logo">
                                                                <div class="logo">
                                                                    <img src="assets/landing/img/logo.png" alt="logo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 invoice-id">
                                                            <div class="info">
                                                                <h1 class="color-white inv-header-1"
                                                                    style="font-size: 16px;">Bukti Transaksi</h1>
                                                                <p class="color-white mb-1">Invoice
                                                                    <span>{{ $item->no_invoice }}</span>
                                                                </p>
                                                                <p class="color-white mb-1">Resi
                                                                    <span>{{ $item->no_resi }}</span>
                                                                </p>
                                                                <p class="color-white mb-1">Status
                                                                    <span><i><b>{{ strtoupper($item->status_pembayaran) }}</b></i></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-top">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="invoice-number mb-30">
                                                                <h4 class="inv-title-1">Invoice To</h4>
                                                                <h2 class="name mb-10" style="font-size: 14px;">
                                                                    {{ Auth::user()->username }}
                                                                </h2>
                                                                <p class="invo-addr-1">
                                                                    {{ Auth::user()->name }} <br />
                                                                    {{ Auth::user()->email }} <br />
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="invoice-number mb-30">
                                                                <div class="invoice-number-inner">
                                                                    <h4 class="inv-title-1">Invoice From</h4>
                                                                    <h2 class="name mb-10" style="font-size: 14px;">
                                                                        {{ $item->customer->nama }}</h2>
                                                                    <p class="invo-addr-1">
                                                                        {{ $item->customer->no_hp }} <br />
                                                                        {{ $item->customer->email }} <br />
                                                                        {{ $item->customer->alamat }} <br />
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-center">
                                                    <div class="table-responsive">
                                                        @php
                                                            $grandTotal = $item->total_harga ?? 0;
                                                            $diskon = $item->disc ?? 0;
                                                            $totalBeforeDiscount = $grandTotal + $diskon;
                                                        @endphp

                                                        <table class="table mb-0 table-striped invoice-table">
                                                            <thead class="bg-active">
                                                                <tr class="tr">
                                                                    <th>No.</th>
                                                                    <th class="pl0 text-start">Item Description</th>
                                                                    <th class="text-center">Price</th>
                                                                    <th class="text-center">Quantity</th>
                                                                    <th class="text-end">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $index = 1; @endphp
                                                                @foreach ($item->items as $itm)
                                                                    <tr>
                                                                        <td>{{ $index++ }}</td>
                                                                        <td>{{ $itm->product->nama_produk }}</td>
                                                                        <td class="text-center">Rp. {{ number_format($itm->harga_per_qty, 2) }}</td>
                                                                        <td class="text-center">{{ $itm->qty }}</td>
                                                                        <td class="text-end">Rp. {{ number_format($itm->total, 2) }}</td>
                                                                    </tr>
                                                                @endforeach

                                                                {{-- Total sebelum diskon --}}
                                                                <tr>
                                                                    <td colspan="4" class="text-end">
                                                                        <strong>Total</strong>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <strong>Rp. {{ number_format($totalBeforeDiscount, 2) }}</strong>
                                                                    </td>
                                                                </tr>

                                                                {{-- Diskon --}}
                                                                <tr>
                                                                    <td colspan="4" class="text-end">
                                                                        <strong>Diskon</strong>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <strong>Rp. {{ number_format($diskon, 2) }}</strong>
                                                                    </td>
                                                                </tr>

                                                                {{-- Subtotal (setelah diskon) --}}
                                                                <tr>
                                                                    <td colspan="4" class="text-end">
                                                                        <strong>SubTotal</strong>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <strong>Rp. {{ number_format($grandTotal, 2) }}</strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="invoice-bottom">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-8 col-sm-7">
                                                            <div class="mb-30 dear-client">
                                                                <h3 class="inv-title-1">Terms & Conditions</h3>
                                                                <p>Dengan menggunakan layanan kami, Anda setuju
                                                                    bahwa kami tidak bertanggung jawab atas
                                                                    kerusakan atau kehilangan barang selama proses
                                                                    pencucian dan pengiriman. Pembayaran wajib
                                                                    dilakukan sesuai harga yang tertera.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-contact clearfix">
                                                    <div class="row g-0">
                                                        <div class="col-lg-9 col-md-11 col-sm-12">
                                                            @foreach ($kontak as $contact)
                                                                <div class="contact-info">
                                                                    <a href="tel:+55-4XX-634-7071"><i
                                                                            class="fa fa-phone"></i>
                                                                        {{ $contact->no_hp }}</a>
                                                                    <a href="tel:info@themevessel.com"><i
                                                                            class="fa fa-envelope"></i>
                                                                        {{ $contact->email }}</a>
                                                                    <a href="tel:info@themevessel.com"
                                                                        class="mr-0 d-none-580"><i
                                                                            class="fa fa-map-marker"></i>
                                                                        {{ $contact->alamat }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-footer mx-6">
                                                    <div class="row g-0">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="footer-info">
                                                                <p>Copyright © {{ date('Y') }} Epon Laundry. All rights
                                                                    reserved.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="invoice-btn-section clearfix d-print-none d-flex justify-content-center align-items-start flex-wrap gap-2 mb-3">
                                                <a href="javascript:window.print()" class="btn btn-lg btn-print">
                                                    <i class="fa fa-print"></i> Print Invoice
                                                </a>
                                                {{-- <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                                                    <i class="fa fa-download"></i> Download Invoice
                                                </a> --}}
                                                <div class="dropdown">
                                                    <button class="btn btn-lg btn-primary dropdown-toggle" type="button"
                                                        id="downloadDropdown{{ $item->id }}" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Download Invoice
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="downloadDropdown{{ $item->id }}">
                                                        <li><a class="dropdown-item btn-download-png" href="#"
                                                                data-id="{{ $item->id }}">File Gambar</a></li>
                                                        <li><a class="dropdown-item btn-download-pdf" href="#"
                                                                data-id="{{ $item->id }}">File PDF</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-hapus" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-secondary">Do you really want to delete this item? This action cannot be
                            undone.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button class="btn w-100" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col">
                                    <form id="delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <!-- html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        function generateFilename(id) {
            const now = new Date();
            const pad = n => n.toString().padStart(2, '0');
            const dd = pad(now.getDate());
            const mm = pad(now.getMonth() + 1);
            const yy = now.getFullYear().toString().slice(-2);
            const hh = pad(now.getHours());
            const mi = pad(now.getMinutes());
            const ss = pad(now.getSeconds());

            return `Invoice_${id}_${dd}${mm}${yy}${hh}${mi}${ss}`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Download PNG
            document.querySelectorAll(".btn-download-png").forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const id = this.getAttribute("data-id");
                    const target = document.querySelector(`#invoice_wrapper_${id}`);

                    html2canvas(target, {
                        scale: 1.5,
                        useCORS: true
                    }).then(canvas => {
                        const imgData = canvas.toDataURL("image/jpeg",
                            0.8);
                        const link = document.createElement("a");
                        // link.download = `invoice_${id}.jpg`;
                        link.download = `${generateFilename(id)}.jpg`;
                        link.href = imgData;
                        link.click();
                    });
                });
            });

            // Download PDF
            document.querySelectorAll(".btn-download-pdf").forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const id = this.getAttribute("data-id");
                    const target = document.querySelector(`#invoice_wrapper_${id}`);

                    html2canvas(target, {
                        scale: 1.5,
                        useCORS: true
                    }).then(canvas => {
                        const imgData = canvas.toDataURL("image/jpeg", 0.8);

                        const imgWidth = canvas.width;
                        const imgHeight = canvas.height;

                        const pxToMm = 0.264583;
                        const pdfWidth = imgWidth * pxToMm;
                        const pdfHeight = imgHeight * pxToMm;

                        const {
                            jsPDF
                        } = window.jspdf;
                        const pdf = new jsPDF({
                            orientation: imgWidth > imgHeight ? 'l' : 'p',
                            unit: 'mm',
                            format: [pdfWidth, pdfHeight]
                        });

                        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                        // pdf.save(`invoice_${id}.pdf`);
                        pdf.save(`${generateFilename(id)}.pdf`);
                    });
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.btn-print').forEach(button => {
            button.addEventListener('click', function() {
                const modal = button.closest('.modal');
                const id = modal.querySelector('[id^="invoice_wrapper_"]').id; // contoh: invoice_wrapper_12
                const target = document.getElementById(id);

                const clone = target.cloneNode(true);
                clone.id = "invoice_wrapper";

                const existing = document.getElementById("invoice_wrapper");
                if (existing) existing.remove();

                document.body.appendChild(clone);

                setTimeout(() => {
                    window.print();
                    setTimeout(() => {
                        clone.remove();
                    }, 1000);
                }, 500);
            });
        });
    </script>

    <script type="text/javascript">
        var tableCustomer;

        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function(e, settings) {
                    // Call the original action function
                    if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-print') >= 0) {
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                    dt.one('preXhr', function(e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);
                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });
            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        }

        $(function() {
            tableCustomer = $('.yajra').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": false,
                "pagingType": 'full_numbers',
                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-7'i><'col-sm-5'p> >>",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    ['Default', '25', '50', 'Semua']
                ],
                "buttons": [{
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn bg-success-lt btn-md',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        action: newexportaction,
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn bg-danger-lt btn-md',
                        text: '<i class="fa fa-file-pdf"></i> Pdf',
                    },
                    {
                        className: 'btn bg-purple-lt btn-md',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                    {
                        className: 'btn bg-blue-lt btn-md',
                        text: '<i class="fa fa-add"></i> Add Sales',
                        action: function(e, dt, node, config) {
                            window.location.href = "{{ route('sales.create') }}";
                        }
                    }
                ],
                "language": {
                    "lengthMenu": "Menampilkan _MENU_",
                    "zeroRecords": "Data Tidak Ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                    "infoEmpty": "Data Tidak Ditemukan",
                    "infoFiltered": "(Difilter dari _MAX_ total records)",
                    "processing": '<div class="container container-slim p-0"><div class="text-center"><div class="mb-3"></div><div class="text-secondary">Loading Data...</div></div></div>',
                    "search": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>',
                    "paginate": {
                        "first": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>',
                        "last": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>',
                        "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>',
                        "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>',
                    },
                },
                "ajax": {
                    "url": "{{ route('getSales.index') }}",
                },
                columns: [{
                        title: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                        data: 'action',
                        name: 'action',
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        title: 'customer',
                        data: 'nama_customer',
                        name: 'nama_customer',
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <strong>${row.nama_customer}</strong><br>
                                <span class="badge bg-blue-lt" style="font-style: italic; font-size: 10px; user-select: text;">No: ${row.no_cust}</span>    
                            `;
                        }
                    },
                    {
                        title: 'no resi',
                        data: 'no_resi',
                        name: 'no_resi',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'no invoice',
                        data: 'no_invoice',
                        name: 'no_invoice',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'total harga',
                        data: 'total_harga',
                        name: 'total_harga',
                        className: "cuspad0 cuspad1 text-center",
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
                        }
                    },
                    {
                        title: 'pembayaran',
                        data: 'metode_pembayaran',
                        name: 'metode_pembayaran',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'status',
                        data: 'status_pembayaran',
                        name: 'status_pembayaran',
                        className: "cuspad0 text-center"
                    },
                ],
            });
            const modal = document.getElementById('modal-hapus');
            const deleteForm = document.getElementById('delete-form');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const recordId = button.getAttribute('data-id');
                deleteForm.action = `/sales/destroy/${recordId}`;
            });
        });
    </script>
@endsection
