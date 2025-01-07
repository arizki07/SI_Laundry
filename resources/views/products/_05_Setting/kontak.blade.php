@extends('layouts.app')
@section('scripts')
    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var eyeIcon = document.getElementById('eye-icon-' + id.split('_')[1]);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
@section('content')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col d-flex justify-content-between align-items-center">
                            <!-- Page title and icon -->
                            <h2 class="page-title d-flex align-items-center">
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
                            <!-- Breadcrumb -->
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#"><i class="fa-solid fa-virus"></i> {{ $judul }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-12 col-md-12 d-flex flex-column">
                                @php
                                    // dd($kontak);
                                    if ($kontak && !$kontak->logo) {
                                        $logo = asset('assets/static/avatars/super.jpg');
                                    } elseif ($kontak && $kontak->logo) {
                                        $logo = Storage::url($kontak->logo);
                                    } else {
                                        $logo = asset('assets/static/avatars/super.jpg');
                                    }
                                @endphp
                                <form action="{{ route('kontak.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h2 class="mb-4">My Account</h2>
                                        <p class="card-subtitle">Data ini akan dimunculkan pada halaman landing pages
                                            aplikasi
                                        </p>
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <img id="avatar" src="{{ $logo }}" alt="Avatar"
                                                    class="avatar avatar-xl"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="col-auto mb-4">
                                                <h3 class="card-title mt-4">Settings</h3>
                                                <p class="card-subtitle">Perbaharui logo atau password akun ini?</p>
                                                <div>
                                                    <label for="avatarInput"
                                                        class="btn me-2 @error('alamat') border-danger @enderror""
                                                        style="font-size: 12px;">Ubah Logo
                                                        Aplikasi</label>
                                                    <input type="file" id="avatarInput" name="logo"
                                                        value="{{ $kontak->logo ?? '' }}" style="display:none"
                                                        accept="image/*" onchange="previewAvatar(event)">
                                                    <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#modal-add{{ Auth::user()->id }}"
                                                        class="btn btn-outline-primary" style="font-size: 12px;">
                                                        <i class="fa-solid fa-lock me-2"></i> Ubah Password
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="card-title mt-4">Landing Kontak</h3>
                                        <div class="row g-3">
                                            <div class="col-md">
                                                <div class="form-label">Heading 1</div>
                                                <input type="text"
                                                    class="form-control @error('head_first') border-danger @enderror""
                                                    name="head_first"
                                                    value="{{ old('head_first', $kontak->head_first ?? '') }}"
                                                    placeholder="Heading One">
                                                <small class="@error('head_first') text-danger @else text-indigo @enderror">
                                                    @error('head_first')
                                                        * {{ $message }}
                                                    @else
                                                        * Judul pertama halaman kontak
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Heading 2</div>
                                                <input type="text"
                                                    class="form-control @error('head_two') border-danger @enderror""
                                                    name="head_two" value="{{ old('head_two', $kontak->head_two ?? '') }}"
                                                    placeholder="Heading Two">
                                                <small class="@error('head_first') text-danger @else text-indigo @enderror">
                                                    @error('head_first')
                                                        * {{ $message }}
                                                    @else
                                                        * Judul kedua halaman kontak
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Deskripsi</div>
                                                <input type="text"
                                                    class="form-control @error('deskripsi') border-danger @enderror""
                                                    name="deskripsi"
                                                    value="{{ old('deskripsi', $kontak->deskripsi ?? '') }}"
                                                    placeholder="Deskripsi Kontak">
                                                <small class="@error('head_first') text-danger @else text-indigo @enderror">
                                                    @error('head_first')
                                                        * {{ $message }}
                                                    @else
                                                        * Deskripsi halaman kontak
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row g-2 mt-3">
                                            <div class="col-md">
                                                <div class="form-label">No Handphone</div>
                                                <input type="text" class="form-control" name="no_hp"
                                                    value="{{ old('no_hp', $kontak->no_hp ?? '') }}"
                                                    placeholder="Nomor Handphone Official">
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Email</div>
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ old('email', $kontak->email ?? '') }}"
                                                    placeholder="Email Official">
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Instagram</div>
                                                <input type="text" class="form-control" name="instagram"
                                                    value="{{ old('instagram', $kontak->instagram ?? '') }}"
                                                    placeholder="Instagram Official">
                                            </div>
                                        </div>
                                        <div class="row g-2 mt-3">
                                            <div class="col-md">
                                                <div class="form-label">facebook</div>
                                                <input type="text" class="form-control" name="facebook"
                                                    value="{{ old('facebook', $kontak->facebook ?? '') }}"
                                                    placeholder="Facebook Official">
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Twitter X</div>
                                                <input type="text" class="form-control" name="twitter"
                                                    value="{{ old('twitter', $kontak->twitter ?? '') }}"
                                                    placeholder="Twitter Official">
                                            </div>
                                            <div class="col-md">
                                                <div class="form-label">Youtube</div>
                                                <input type="text" class="form-control" name="youtube"
                                                    value="{{ old('youtube', $kontak->youtube ?? '') }}"
                                                    placeholder="Youtube Official">
                                            </div>
                                        </div>
                                        <div class="row g-2 mt-3 mb-6">
                                            <div class="col-md-6">
                                                <div class="form-label">Alamat Toko</div>
                                                <textarea class="form-control @error('alamat') border-danger @enderror" name="alamat" rows="6"
                                                    placeholder="Alamat Official">{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                                                @error('alamat')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror

                                                <div class="form-label mt-3">Maps Official</div>
                                                <textarea class="form-control" name="maps" rows="6"
                                                    placeholder="Link Maps Official Cth: https://www.google.com/maps/embed?pb.....">{{ old('maps', $kontak->maps ?? '') }}</textarea>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-label">Peta Lokasi</div>
                                                <div class="position-relative rounded overflow-hidden h-100">
                                                    <iframe class="position-relative w-100 h-100 rounded"
                                                        src="{{ $kontak->maps ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.1043761584965!2d109.25800496389006!3d-7.400152467374043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70e56c9b94dcbf%3A0xd462cbd2ef004e98!2sTelkom%20University%20Purwokerto!5e0!3m2!1sen!2sid!4v1603794290143!5m2!1sen!2sid&zoom=15' }}"
                                                        frameborder="0" style="min-height: 20px; border: 0;"
                                                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                </div>
                                                @if ($kontak && !$kontak->maps)
                                                    <small class="text-danger fw-bold"><i>*
                                                            {{ __('Link maps belum diatur') }}</i></small>
                                                @endif

                                            </div>
                                        </div>


                                    </div>
                                    <div class="card-footer bg-transparent mt-auto">
                                        <div class="btn-list justify-content-end">
                                            <a href="#" class="btn">
                                                Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
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
@endsection

@section('modals')
    <div class="modal modal-blur fade" id="modal-add{{ Auth::user()->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue-lt">
                    <h5 class="modal-title text-blue">Form Edit Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.update', Auth::user()->id) . '?update=pass' }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_saat_ini" class="form-control" required
                                    placeholder="Masukkan Password Saat Ini" id="password_saat_ini">
                                <span class="input-group-text">
                                    <a href="#" class="input-group-link" onclick="togglePassword('password_saat_ini')">
                                        <i id="eye-icon-now" class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_baru" class="form-control" required
                                    placeholder="Masukkan Password Baru" id="password_baru">
                                <span class="input-group-text">
                                    <a href="#" class="input-group-link" onclick="togglePassword('password_baru')">
                                        <i id="eye-icon-new" class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_baru_confirmation" class="form-control" required
                                    placeholder="Masukkan Kembali Password Baru" id="password_baru_confirmation">
                                <span class="input-group-text">
                                    <a href="#" class="input-group-link"
                                        onclick="togglePassword('password_baru_confirmation')">
                                        <i id="eye-icon-confirm" class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
