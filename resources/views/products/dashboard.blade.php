@extends('layouts.app')

@section('styles')
    <style>
        #month-picker {
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487') }}" defer></script>
    <script>
        // SALES
        document.addEventListener("DOMContentLoaded", function() {
            const salesData = @json($sales);

            const dates = salesData.map(sale => sale.date);
            const salesTotals = salesData.map(sale => sale.total_sales);

            window.ApexCharts && (new ApexCharts(document.getElementById('chart-sales'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 288,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Sales Income",
                    data: salesTotals
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    categories: dates,
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });

        // TRANSAKSI
        document.addEventListener("DOMContentLoaded", function() {
            // Data transaksi dari backend
            const transactionStatus = @json($transaction_status);

            // Render grafik donat
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-demo-pie"), {
                    chart: {
                        type: "donut",
                        fontFamily: "inherit",
                        height: 278,
                        sparkline: {
                            enabled: true,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [
                        transactionStatus.pending,
                        transactionStatus.gagal,
                        transactionStatus.berhasil,
                        transactionStatus.refund,
                    ],
                    labels: ["Pending", "Gagal", "Berhasil", "Refund"],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    colors: [
                        tabler.getColor("warning"),
                        tabler.getColor("danger"),
                        tabler.getColor("success"),
                        tabler.getColor("info"),
                    ],
                    legend: {
                        show: true,
                        position: "bottom",
                        offsetY: 12,
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 100,
                        },
                        itemMargin: {
                            horizontal: 8,
                            vertical: 8,
                        },
                    },
                    tooltip: {
                        fillSeriesColor: false,
                    },
                }).render();
        });
    </script>

    <script>
        function updateClock() {
            const options = {
                weekday: 'short',
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZoneName: 'short',
            };

            const now = new Date();
            const formattedTime = now.toLocaleDateString('id-ID', options).replace('Waktu Indonesia Barat', 'WIB');

            document.getElementById('realtime-clock').value = formattedTime;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <input type="text" id="realtime-clock" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-md">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                                    <path d="M10 10l.01 0" />
                                    <path d="M14 10l.01 0" />
                                    <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h3 class="h1">Selamat datang di Indah Laundry</h3>
                                    <div class="markdown text-secondary">
                                        Terima kasih telah berhasil login! Anda dapat mengelola pesanan laundry dan memantau
                                        statusnya.
                                        @if (Auth::user()->role == 'admin')
                                            Sebagai Admin, Anda dapat mengatur pengelolaan pesanan dan karyawan.
                                        @else
                                            Sebagai Karyawan, Anda bisa melihat dan memperbarui status pesanan yang sedang
                                            dikerjakan.
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('sales.index') }}" class="btn btn-primary">Lihat Pesanan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-lg-6">
                            <div class="col-sm-12 col-lg-12">
                                <div class="card" style="height: 238px">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Login Session
                                        </h3>
                                        <div class="card-actions">
                                            <a href="{{ route('kontak.index') }}">
                                                Show Profile
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row">
                                            <dt class="col-5">Login Date</dt>
                                            <dd class="col-7">:
                                                {{ \Carbon\Carbon::parse($config->created_at)->locale('id')->isoFormat('ddd, D MMM YYYY HH:mm [WIB]') }}
                                            </dd>
                                            <dt class="col-5">IP Address</dt>
                                            <dd class="col-7">: {{ $config->ip_address }}</dd>
                                            <dt class="col-5">Akun</dt>
                                            <dd class="col-7">: {{ Auth::user()->name }}</dd>
                                            <dt class="col-5">Email</dt>
                                            <dd class="col-7">: {{ Auth::user()->email }}</dd>
                                            <dt class="col-5">Role</dt>
                                            <dd class="col-7">: <span
                                                    class="badge {{ Auth::user()->role == 'admin' ? 'bg-indigo-lt' : 'bg-lime-lt' }}">{{ Auth::user()->role }}</span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cards mb-2">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span
                                                        class="bg-red-lt avatar"><!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 5l0 14" />
                                                            <path d="M18 13l-6 6" />
                                                            <path d="M6 13l6 6" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        342
                                                        <span class="float-right font-weight-medium text-red">-4.3%</span>
                                                    </div>
                                                    <div class="text-secondary">
                                                        Sales last 30 days
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green-lt avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 5l0 14" />
                                                            <path d="M18 11l-6 -6" />
                                                            <path d="M6 11l6 -6" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        $5,256.99
                                                        <span class="float-right font-weight-medium text-green">+4%</span>
                                                    </div>
                                                    <div class="text-secondary">
                                                        Revenue last 30 days
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards mb-2">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-orange-lt avatar">
                                                        <i class="fa-solid fa-cart-shopping fs--2"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Data Product
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \App\Models\ProductModel::count() }} Product
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-indigo-lt avatar">
                                                        <i class="fa-solid fa-truck-fast fs--2"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Data Resi History
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \App\Models\ResiHistoryModel::count() }} Resi History
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-cyan-lt avatar">
                                                        <i class="fa-solid fa-user-tag fs--2"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Data Pelanggan
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \App\Models\CustomerModel::count() }} Customers
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-purple-lt avatar">
                                                        <i class="fa-solid fa-user-lock fs--2"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Data User
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \App\Models\User::count() }} Akun User
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-6">
                            <div class="card" style="height: 400px;">
                                <div class="card-header">
                                    <h3 class="card-title">50 Aktifitas Terbaru</h3>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        @foreach ($logs as $item)
                                            <div class="py-3">
                                                <div class="row">
                                                    <!-- Avatar atau Ikon -->
                                                    <div class="col-auto">
                                                        <span
                                                            class="avatar bg-primary-lt">{{ $item->user_id != 'Guest' ? 'US' : 'GU' }}</span>
                                                    </div>
                                                    <!-- Informasi Log -->
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <strong>Activity</strong> at
                                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="text-secondary">
                                                            <span>User:
                                                                @foreach (\App\Models\User::all() as $us)
                                                                    @if ($us->id == $item->user_id)
                                                                        {{ $us->name }}
                                                                    @else
                                                                        {{ $item->user_id }}
                                                                    @endif
                                                                @endforeach
                                                            </span> | <span>IP: {{ $item->ip_address }}</span> |
                                                            <span>{{ $item->method }} {{ $item->path }}</span>
                                                        </div>
                                                    </div>
                                                    <!-- Status -->
                                                    <div class="col-auto align-self-center">
                                                        <div
                                                            class="badge bg-{{ $item->status == 200 ? 'success' : 'secondary' }}">
                                                            {{ $item->status }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="card" style="height: 400px;">
                                <div class="card-header">
                                    <h3 class="card-title">Status Transaksi</h3>
                                </div>
                                <div class="card-body mt-4">
                                    <div id="chart-demo-pie"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="card-title mb-3">Grafik Keuangan</h3>
                                        <div class="ms-auto">
                                            <form method="GET" action="{{ url('/dashboard') }}"
                                                class="d-flex align-items-center gap-2">

                                                {{-- Bulan --}}
                                                <select name="month" class="form-select form-select-sm"
                                                    onchange="this.form.submit()">
                                                    @foreach (range(1, 12) as $m)
                                                        <option value="{{ $m }}"
                                                            {{ $current_month == $m ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{-- Tahun --}}
                                                <select name="year" class="form-select form-select-sm"
                                                    onchange="this.form.submit()">
                                                    @foreach (range(date('Y') - 5, date('Y')) as $y)
                                                        <option value="{{ $y }}"
                                                            {{ $current_year == $y ? 'selected' : '' }}>
                                                            {{ $y }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div id="chart-sales"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
