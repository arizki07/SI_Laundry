<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <img class="img-fluid m-0 px-4 px-lg-5" src="{{ $logo }}" alt="Logo-Website">
    <button type="button" class="navbar-toggler me-2" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse me-4" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('landing.home') }}"
                class="nav-item nav-link {{ $act == 'home' ? 'active' : '' }}">Home</a>
            <a href="{{ route('landing.tentang-kami') }}"
                class="nav-item nav-link {{ $act == 'about' ? 'active' : '' }}">Tentang Kami</a>
            <a href="{{ route('landing.tentang-kami') }}"
                class="nav-item nav-link {{ $act == 'testimoni' ? 'active' : '' }}">Testimoni</a>
            <a href="{{ route('landing.testimoni') }}"
                class="nav-item nav-link {{ $act == 'services' ? 'active' : '' }}">Daftar Harga</a>
            <a href="{{ route('landing.cek-resi') }}" class="nav-item nav-link {{ $act == 'resi' ? 'active' : '' }}">Cek
                Resi</a>
            <div class="nav-item dropdown">
                <a href="{{ route('landing.home') }}" class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown">Lainnya</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="{{ route('landing.syarat-ketentuan') }}" class="dropdown-item">Syarat Dan Ketentuan</a>
                    <a href="{{ route('landing.bantuan') }}" class="dropdown-item">Perlu Bantuan?</a>
                </div>
            </div>
            <a href="{{ route('landing.hubungi-kami') }}"
                class="nav-item nav-link {{ $act == 'contact' ? 'active' : '' }}">Contact</a>
        </div>
        {{-- <a href="javascript:void(0)" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Pesan Laundry<i class="fa fa-arrow-right ms-3"></i></a> --}}
    </div>
</nav>
