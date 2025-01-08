@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/dist/libs/star-rating.js/dist/star-rating.min.css?1692870487') }}" rel="stylesheet" />
@endsection

@section('content')
    @include('shared.table')
@endsection

@section('modals')
    <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue-lt">
                    <h5 class="modal-title text-blue">Tambah Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rating.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">No Hp Customers</label>
                            <select class="form-select" name="no_hp_cust">
                                <option selected>Pilih Customer</option>
                                @foreach (\App\Models\CustomerModel::all() as $ds)
                                    <option value="{{ $ds->no_hp }}">{{ $ds->no_hp }} - {{ $ds->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Penilaian</label>
                                <select id="rating-add" name="rating">
                                    <option value="">Select a rating</option>
                                    <option value="5">Excellent</option>
                                    <option value="4" selected>Very Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Poor</option>
                                    <option value="1">Terrible</option>
                                </select>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-label">Tampilkan Reviews</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="ya"
                                            checked>
                                        <span class="form-check-label">Ya</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="tidak">
                                        <span class="form-check-label">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea class="form-control" name="komentar" rows="3" placeholder="Komentar..."></textarea>
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

    @foreach ($rating as $item)
        <div class="modal modal-blur fade" id="modal-edit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue-lt">
                        <h5 class="modal-title text-blue">Edit Rating</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rating.update', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">No Hp Customers</label>
                                <select class="form-select" name="no_hp_cust">
                                    <option selected>Pilih Customer</option>
                                    @foreach (\App\Models\CustomerModel::all() as $ds)
                                        <option value="{{ $item->no_hp_cust }}"
                                            {{ $item->no_hp_cust == $ds->no_hp ? 'selected' : '' }}>{{ $ds->no_hp }} -
                                            {{ $ds->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Penilaian</label>
                                    <select id="rating-edit" name="rating">
                                        <option value="">Select a rating</option>
                                        <option value="{{ $item->rating }}" {{ $item->rating == 5 ? 'selected' : '' }}></option>
                                        <option value="{{ $item->rating }}" {{ $item->rating == 5 ? 'selected' : '' }} selected></option>
                                        <option value="{{ $item->rating }}" {{ $item->rating == 3 ? 'selected' : '' }}></option>
                                        <option value="{{ $item->rating }}" {{ $item->rating == 2 ? 'selected' : '' }}></option>
                                        <option value="{{ $item->rating }}" {{ $item->rating == 1 ? 'selected' : '' }}></option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-label">Tampilkan Reviews</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                            <span class="form-check-label">Ya</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="2"
                                                {{ $item->status == 2 ? 'checked' : '' }}>
                                            <span class="form-check-label">Tidak</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Komentar</label>
                                <textarea class="form-control" name="komentar" rows="3" placeholder="Komentar...">{{ $item->komentar }}</textarea>
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


        <div class="modal modal-blur fade" id="modal-hapus" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    {{-- <div class="modal-status bg-danger-lt"></div> --}}
                    <div class="modal-body text-center text-danger py-4">
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="{{ asset('assets/dist/libs/star-rating.js/dist/star-rating.min.js?1692870487') }}" defer></script>
    <script type="text/javascript">
        var tableData;

        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
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
                    {
                        className: 'btn bg-blue-lt btn-md',
                        text: '<i class="fa fa-add"></i> Add Rating',
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
                    "url": "{{ route('getRating.index') }}"
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
                        title: 'Customer',
                        data: 'no_hp_cust',
                        name: 'no_hp_cust',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'Tanggal',
                        data: 'updated_at',
                        name: 'updated_at',
                        className: "cuspad0 text-center",
                        render: function(data, type, row) {
                            return moment(data).format('D MMMM YYYY HH:mm [WIB]');
                        }
                    },
                    {
                        title: 'Rating',
                        data: 'rating',
                        name: 'rating',
                        className: "cuspad0 cuspad1 text-center",
                        render: function(data, type, row) {
                            let stars = '';
                            const fullStar =
                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFC107" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.396.198-.86-.106-.746-.592l.83-4.73-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696 2.193-4.396c.197-.395.73-.395.927 0l2.193 4.396 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.114.486-.35.79-.746.592L8 13.187l-4.389 2.256z"/></svg>';
                            const emptyStar =
                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#E0E0E0" class="bi bi-star" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.345 5.188l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767L8 11.9l1.23.65-.296-1.686 1.19-1.13-1.657-.24L8 7.329l-.467.95-1.657.24 1.19 1.13-.296 1.686 1.23-.65z"/></svg>';
                            for (let i = 1; i <= 5; i++) {
                                stars += i <= data ? fullStar : emptyStar;
                            }
                            return stars;
                        }
                    },
                    {
                        title: 'flag',
                        data: 'status',
                        name: 'status',
                        className: "cuspad0 cuspad1 text-center"
                    },
                ],
            });
            const modal = document.getElementById('modal-hapus');
            const deleteForm = document.getElementById('delete-form');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const recordId = button.getAttribute('data-id');
                deleteForm.action = `/rating/destroy/${recordId}`;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ratingAdd = new StarRating('#rating-add', {
                tooltip: false,
                clearable: false,
                stars: function(el, item, index) {
                    el.innerHTML =
                        `<!-- Download SVG icon from http://tabler-icons.io/i/star-filled -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon gl-star-full icon-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor" />
                </svg>`;
                },
            });

            const ratingEdit = new StarRating('#rating-edit', {
                tooltip: false,
                clearable: false,
                stars: function(el, item, index) {
                    el.innerHTML =
                        `<!-- Download SVG icon from http://tabler-icons.io/i/star-filled -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon gl-star-full icon-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor" />
                </svg>`;
                },
            });
        })
    </script>
@endsection
