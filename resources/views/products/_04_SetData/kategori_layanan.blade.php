@extends('layouts.app')

@section('content')
    @include('shared.table')
@endsection

@section('modals')
    <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue-lt">
                    <h5 class="modal-title text-blue">Tambah {{ $judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori-layanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama_kategori_layanan" class="form-control" required
                                    placeholder="Masukkan nama kategori layanan" value="{{ old('nama_kategori_layanan') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Flag Kategori</label>
                                <select class="form-select" name="flag">
                                    <option selected disabled>--Pilih--</option>
                                    <option value="1" {{ old('flag') == '1' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('flag') == '0' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Durasi</label>
                                <select class="form-select" name="type_durasi">
                                    <option selected disabled>--Pilih--</option>
                                    <option value="hari" {{ old('type_durasi') == 'hari' ? 'selected' : '' }}>Harian
                                    </option>
                                    <option value="jam" {{ old('type_durasi') == 'jam' ? 'selected' : '' }}>Jam</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Durasi Jam/Hari</label>
                                <input type="text" name="durasi" class="form-control" required
                                    placeholder="Masukkan Durasi angka cth : 3" value="{{ old('durasi') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required placeholder="Masukkan harga"
                                value="{{ old('harga') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="6" placeholder="Isi deskripsi category"></textarea>
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

    @foreach ($cat as $item)
        <div class="modal modal-blur fade" id="modal-edit{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue-lt">
                        <h5 class="modal-title text-blue">Edit {{ $judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kategori-layanan.update', $item->id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama_kategori_layanan" class="form-control" required
                                        placeholder="Masukkan nama kategori layanan" value="{{ old('nama_kategori_layanan', $item->nama_kategori_layanan) }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Flag Kategori</label>
                                    <select class="form-select" name="flag">
                                        <option disabled>--Pilih--</option>
                                        <option value="1" {{ $item->flag == 1 ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $item->flag == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tipe Durasi</label>
                                    <select class="form-select" name="type_durasi">
                                        <option disabled>--Pilih--</option>
                                        <option value="hari" {{ $item->type_durasi == 'hari' ? 'selected' : '' }}>Harian</option>
                                        <option value="jam" {{ $item->type_durasi == 'jam' ? 'selected' : '' }}>Jam</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Durasi Jam/Hari</label>
                                    <input type="text" name="durasi" class="form-control" required
                                        placeholder="Masukkan Durasi angka cth : 3" value="{{ old('durasi', $item->durasi) }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" required placeholder="Masukkan harga"
                                    value="{{ old('harga', $item->harga) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="6" placeholder="Isi deskripsi kategori">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

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
@endsection

@section('scripts')
    <script type="text/javascript">
        var tableData;

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
                        className: 'btn bg-purple-lt btn-md',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                    {
                        className: 'btn bg-blue-lt btn-md',
                        text: '<i class="fa fa-add"></i> Tambah Kategori Layanan',
                        action: function(e, dt, node, config) {
                            $('#modal-add').modal('show');
                        },
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
                    "url": "{{ route('getKategoriLayanan.index') }}",
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
                        title: 'nama',
                        data: 'nama_kategori_layanan',
                        name: 'nama_kategori_layanan',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'harga',
                        data: 'harga',
                        name: 'harga',
                        className: "cuspad0 cuspad1 text-center",
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
                        }
                    },
                    {
                        title: 'durasi',
                        data: 'type_durasi',
                        name: 'type_durasi',
                        className: "cuspad0 cuspad1 text-center",
                        render: function(data, type, row) {
                            var durasi = row.durasi;
                            if (data === 'hari') {
                                return durasi + ' hari';
                            } else if (data === 'jam') {
                                return durasi + ' jam';
                            }
                            return data;
                        }
                    }
                ],
            });
            const modal = document.getElementById('modal-hapus');
            const deleteForm = document.getElementById('delete-form');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const recordId = button.getAttribute('data-id');
                deleteForm.action = `/kategori-layanan/destroy/${recordId}`;
            });
        });
    </script>
@endsection
