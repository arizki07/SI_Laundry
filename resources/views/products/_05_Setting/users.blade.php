@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <h2 class="page-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg>
                            {{ $judul }}
                        </h2>
                        <div class="page-pretitle">
                            <ol class="breadcrumb" aria-label="breadcrumbs">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                        Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                            class="fa-solid fa-users"></i> {{ $judul }}</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" />
                            <a class="btn" data-bs-toggle="offcanvas" href="#modal-add" role="button"
                                aria-controls="offcanvasEnd">
                                Tambah User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    @foreach ($user as $item)
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body p-4 text-center">
                                    <span class="avatar avatar-xl mb-3 rounded"
                                        style="background-image: url({{ asset('assets/static/avatars/super.jpg') }})"></span>
                                    <h3 class="m-0 mb-1"><a href="#">{{ $item->username }}</a></h3>
                                    <div class="text-secondary">{{ $item->name }}</div>
                                    <div class="mt-3">
                                        <span class="badge bg-purple-lt">{{ $item->role }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="card-btn" data-bs-toggle="offcanvas" href="#modal-edit{{ $item->id }}"
                                        aria-controls="offcanvasEnd">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                        edit</a>
                                    <a href="#"
                                        class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        hapus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @section('modals')
        <div class="offcanvas offcanvas-end" tabindex="-1" id="modal-add" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Modal tambah</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{ route('user.store') }}" method="POST">
                    <div>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input placeholder">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Input placeholder">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">email</label>
                            <input type="text" class="form-control" name="email" placeholder="Input placeholder">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input placeholder">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Role</div>
                            <select class="form-select" name="role">
                                <option selected disabled>--Pilih Role--</option>
                                <option value="admin">admin</option>
                                <option value="karyawan">karyawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($user as $item)
            <div class="offcanvas offcanvas-end" tabindex="-1" id="modal-edit{{ $item->id }}"
                aria-labelledby="offcanvasEndLabel">
                <div class="offcanvas-header">
                    <h2 class="offcanvas-title" id="offcanvasEndLabel">Modal edit</h2>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('user.update', $item->id) }}" method="POST">
                        <div>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Input placeholder" value="{{ $item->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username"
                                    placeholder="Input placeholder" value="{{ $item->username }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input type="text" class="form-control" name="email"
                                    placeholder="Input placeholder" value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Input placeholder" value="{{ $item->password }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Role</div>
                                <select class="form-select" name="role">
                                    <option selected disabled>--Pilih Role--</option>
                                    <option value="admin" {{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="karyawan"
                                        {{ old('role', $item->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                </select>
                            </div>

                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endsection
</div>
@endsection
