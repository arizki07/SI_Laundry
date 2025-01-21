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
                                    <div class="mt-3">
                                        <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                                <!-- Card footer for buttons -->
                                <div class="card-footer text-center">
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-success mx-2" data-bs-toggle="offcanvas"
                                            href="#modal-edit{{ $item->id }}" aria-controls="offcanvasEnd"
                                            style="padding: 2px;">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger mx-2 delete-button"
                                            data-id="{{ $item->id }}" style="padding: 2px;">
                                            <i class="fas fa-trash-alt fa-2x"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning mx-2 status-button"
                                            data-id="{{ $item->id }}" data-status="{{ $item->status }}"
                                            style="padding: 2px;">
                                            <i class="fas fa-toggle-{{ $item->status ? 'on' : 'off' }} fa-2x"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <ul class="pagination">
                        <!-- Previous button -->
                        @if ($user->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $user->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                        @endif

                        <!-- Page numbers -->
                        @foreach ($user->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $user->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Next button -->
                        @if ($user->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $user->nextPageUrl() }}">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @section('modals')
        <div class="offcanvas offcanvas-end" tabindex="-1" id="modal-add" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Modal tambah</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
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
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Update status
                $(document).on('click', '.status-button', function(e) {
                    e.preventDefault();

                    const id = $(this).data('id');
                    const currentStatus = $(this).data('status');

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: currentStatus ? "Ubah status menjadi Inactive?" :
                            "Ubah status menjadi Active?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Ubah!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/user/update-status/' + id,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                                data: {
                                    status: currentStatus ? 0 : 1
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "Status berhasil diperbarui.",
                                            icon: "success"
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Gagal!",
                                            text: response.message ||
                                                "Status gagal diperbarui.",
                                            icon: "error"
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Terjadi kesalahan pada server.",
                                        icon: "error"
                                    });
                                }
                            });
                        }
                    });
                });

                // DELETE
                $(document).on('click', '.delete-button', function(e) {
                    e.preventDefault();

                    const id = $(this).data('id');

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/user/destroy/' + id,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            title: "Dihapus!",
                                            text: "Data berhasil dihapus.",
                                            icon: "success"
                                        });

                                        // Hapus kartu pengguna tanpa reload
                                        $(`a[data-id="${id}"]`).closest('.col-md-6')
                                            .remove();
                                    } else {
                                        Swal.fire({
                                            title: "Gagal!",
                                            text: response.message ||
                                                "Data gagal dihapus.",
                                            icon: "error"
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Terjadi kesalahan pada server.",
                                        icon: "error"
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endsection

</div>
@endsection
