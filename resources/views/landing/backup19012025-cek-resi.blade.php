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

    <!-- Service Start -->
    <div class="container-fluid">
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
                            <div id="invoiceList"></div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endSection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.min.js"></script>
    <link
        href="{{ asset('assets/landing/js/jspdf.min.js') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/js/jspdf.min.js'))) }}"
        rel="stylesheet">
    <script>
        function checkResi() {
            const resiInput = document.getElementById('resiInput').value.trim();

            if (resiInput) {
                const resiList = document.getElementById('resiList');
                const invoiceList = document.getElementById('invoiceList');
                resiList.innerHTML = '';
                invoiceList.innerHTML = '';

                const listItem = document.createElement('div');
                listItem.innerHTML = `<h5 class="fw-bold mb-2">Search Result:</h5>
                    <div class="container padding-bottom-3x mb-4">
                        <div class="card mb-3 shadow" style="border: 0px;">
                            <div class="p-4 text-center text-white text-lg rounded-top" style="background-image: linear-gradient(to bottom, #ff0000, #ff8100);">
                                <span class="text-uppercase">Tracking Order No - </span><span class="text-medium">${resiInput}</span>
                            </div>
                            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Shipped Via:</span> UPS Ground</div>
                                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span> Checking Quality</div>
                                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Expected Date:</span> SEP 09, 2017</div>
                            </div>
                            <div class="card-body">
                                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fa fa-check-circle"></i></div>
                                        </div>
                                        <h4 class="step-title">Confirmed Order</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fa fa-cogs"></i></div>
                                        </div>
                                        <h4 class="step-title">Processing Order</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fa fa-check"></i></div>
                                        </div>
                                        <h4 class="step-title">Quality Check</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fa fa-truck"></i></div>
                                        </div>
                                        <h4 class="step-title">Product Dispatched</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fa fa-home"></i></div>
                                        </div>
                                        <h4 class="step-title">Product Delivered</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                resiList.appendChild(listItem);

                const invoiceItem = document.createElement('div');
                invoiceItem.innerHTML = `
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
                                                            <p class="color-white mb-1">Invoice Number <span>#45613</span></p>
                                                            <p class="color-white mb-0">Invoice Date <span>21 Sep 2021</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invoice-top">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="invoice-number mb-30">
                                                            <h4 class="inv-title-1">Invoice To</h4>
                                                            <h2 class="name mb-10">Jhon Smith</h2>
                                                            <p class="invo-addr-1">
                                                                Theme Vessel <br/>
                                                                info@themevessel.com <br/>
                                                                21-12 Green Street, Meherpur, Bangladesh <br/>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="invoice-number mb-30">
                                                            <div class="invoice-number-inner">
                                                                <h4 class="inv-title-1">Invoice From</h4>
                                                                <h2 class="name mb-10">Animas Roky</h2>
                                                                <p class="invo-addr-1">
                                                                    Apexo Inc  <br/>
                                                                    billing@apexo.com <br/>
                                                                    169 Teroghoria, Bangladesh <br/>
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
                                                            <th class="pl0 text-start">Item Description</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-end">Amount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="tr">
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    <span>01</span>
                                                                </div>
                                                            </td>
                                                            <td class="pl0">Businesscard Design</td>
                                                            <td class="text-center">$300</td>
                                                            <td class="text-center">2</td>
                                                            <td class="text-end">$600.00</td>
                                                        </tr>
                                                        <tr class="bg-grea">
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    <span>02</span>
                    
                                                                </div>
                                                            </td>
                                                            <td class="pl0">Fruit Flayer Design</td>
                                                            <td class="text-center">$400</td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-end">$60.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    <span>03</span>
                                                                </div>
                                                            </td>
                                                            <td class="pl0">Application Interface Design</td>
                                                            <td class="text-center">$240</td>
                                                            <td class="text-center">3</td>
                                                            <td class="text-end">$640.00</td>
                                                        </tr>
                    
                                                        <tr>
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    <span>04</span>
                                                                </div>
                                                            </td>
                                                            <td class="pl0">Theme Development</td>
                                                            <td class="text-center">$720</td>
                                                            <td class="text-center">4</td>
                                                            <td class="text-end">$640.00</td>
                                                        </tr>
                                                        <tr class="tr2">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">SubTotal</td>
                                                            <td class="text-end">$710.99</td>
                                                        </tr>
                                                        <tr class="tr2">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">Tax</td>
                                                            <td class="text-end">$85.99</td>
                                                        </tr>
                                                        <tr class="tr2">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center f-w-600 active-color">Grand Total</td>
                                                            <td class="f-w-600 text-end active-color">$795.99</td>
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
                                                            <p>Dengan menggunakan layanan kami, Anda setuju bahwa kami tidak bertanggung jawab atas kerusakan atau kehilangan barang selama proses pencucian dan pengiriman. Pembayaran wajib dilakukan sesuai harga yang tertera.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-4 col-sm-5">
                                                        <div class="mb-30 payment-method">
                                                            <h3 class="inv-title-1">Payment Method</h3>
                                                            <ul class="payment-method-list-1 text-14">
                                                                <li><strong>Account No:</strong> 00 123 647 840</li>
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
                                                            <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +00 123 647 840</a>
                                                            <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i> info@themevessel.com</a>
                                                            <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> 169 Teroghoria, Bangladesh</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-btn-section clearfix d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-lg btn-print mb-3">
                                                <i class="fa fa-print"></i> Print Invoice
                                            </a>
                                            <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme mb-3">
                                                <i class="fa fa-download"></i> Download Invoice
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                invoiceList.appendChild(invoiceItem);

                document.getElementById('resiInput').value = '';
            } else {
                new Notify({
                    status: 'error',
                    title: 'Error!',
                    text: 'Mohon masukkan nomor resi yang valid!',
                    effect: 'slide',
                    speed: 300,
                    autoplay: true,
                    position: 'right top',
                });
            }
        }
    </script>
@endsection
