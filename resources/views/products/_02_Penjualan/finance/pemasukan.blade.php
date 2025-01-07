@extends('layouts.app')
@section('styles')<link href="{{ asset('assets/landing/css/invoice.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/invoice.css'))) }}" rel="stylesheet">@endsection
@section('content') @include('shared.table') @endsection

@section('modals')
@foreach ($sales as $item)
    <div class="modal modal-blur fade" id="modal-view{{ $item->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Sales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="invoice-1 invoice-content" style="background-color: white;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-inner clearfix shadow">
                                        <div class="invoice-info clearfix" id="invoice_wrapper">
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
                                                            <h1 class="color-white inv-header-1">Invoice</h1>
                                                            <p class="color-white mb-1">Invoice
                                                                <span>{{ $item->no_invoice }}</span>
                                                            </p>
                                                            <p class="color-white mb-0">Invoice Date
                                                                <span>{{ $item->created_at->format('d M Y') }}</span>
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
                                                            <h2 class="name mb-10">{{ Auth::user()->username }}
                                                            </h2>
                                                            <p class="invo-addr-1">
                                                                {{ Auth::user()->name }} <br />
                                                                {{ Auth::user()->email }} <br />
                                                                21-12 Green Street, Meherpur, Bangladesh <br />
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="invoice-number mb-30">
                                                            <div class="invoice-number-inner">
                                                                <h4 class="inv-title-1">Invoice From</h4>
                                                                <h2 class="name mb-10">
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
                                                    <table class="table mb-0 table-striped invoice-table">
                                                        <thead class="bg-active">
                                                            <tr class="tr">
                                                                <th>No.</th>
                                                                <th class="pl0 text-start">Item Description
                                                                </th>
                                                                <th class="text-center">Price</th>
                                                                <th class="text-center">Quantity</th>
                                                                <th class="text-end">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sales as $sale)
                                                                @foreach ($sale->items as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $item->product->nama_produk }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            Rp.
                                                                            {{ number_format($item->harga_per_qty, 2) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item->qty }}</td>
                                                                        <td class="text-end">
                                                                            Rp.
                                                                            {{ number_format($item->total, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="4" class="text-center">
                                                                        <strong>SubTotal</strong>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        Rp.
                                                                        {{ number_format($sale->total_harga, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

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
                                                    <div class="col-lg-6 col-md-4 col-sm-5">
                                                        <div class="mb-30 payment-method">
                                                            <h3 class="inv-title-1">Payment Method</h3>
                                                            <ul class="payment-method-list-1 text-14">
                                                                <li><strong>Account No:</strong> 00 123 647 840
                                                                </li>
                                                                <li><strong>Account Name:</strong> Jhon Doe</li>
                                                                <li><strong>Branch Name:</strong> xyz</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invoice-contact clearfix">
                                                <div class="row g-0">
                                                    <div class="col-lg-9 col-md-11 col-sm-12">
                                                        <div class="contact-info">
                                                            <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i>
                                                                +00 123 647
                                                                840</a>
                                                            <a href="tel:info@themevessel.com"><i
                                                                    class="fa fa-envelope"></i>
                                                                info@themevessel.com</a>
                                                            <a href="tel:info@themevessel.com"
                                                                class="mr-0 d-none-580"><i
                                                                    class="fa fa-map-marker"></i> 169
                                                                Teroghoria, Bangladesh</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-btn-section clearfix d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-lg btn-print mb-3">
                                                <i class="fa fa-print"></i> Print Invoice
                                            </a>
                                            <a id="invoice_download_btn"
                                                class="btn btn-lg btn-download btn-theme mb-3">
                                                <i class="fa fa-download"></i> Download Invoice
                                            </a>
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
@endforeach
@endsection

@section('scripts')
<script type="text/javascript">
    var tableData;

    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function(e, s, data) {
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function(e, settings) {
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
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                setTimeout(dt.ajax.reload, 0);
                return false;
            });
        });
        dt.ajax.reload();
    }

    $(function() {
        tableData = $('.yajra').DataTable({
            "processing": true,
            "serverSide": false,
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
                "url": "{{ route('getPemasukan.index') }}",
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
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
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
    });
</script>
@endsection
