@extends('layouts.app')

@section('content')
    @include('shared.table')
@endsection

@section('modals')
    @foreach ($logs as $item)
        <div class="modal modal-blur fade" id="modal-view{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue-lt">
                        <h5 class="modal-title text-blue">View Log Activity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Details</h4>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Field</th>
                                                <th scope="col">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pukul</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->locale('id')->isoFormat('HH:mm [WIB]') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User</td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if ($user->id == $item->user_id)
                                                            {{ $user->name }}
                                                        @else
                                                            {{ $item->user_id }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>IP Address</td>
                                                <td>{{ $item->ip_address }}</td>
                                            </tr>
                                            <tr>
                                                <td>URL Access</td>
                                                <td>{{ $item->method }} {{ $item->path }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td><span class="badge bg-indigo-lt">{{ $item->status }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>Activity</td>
                                                <td>
                                                    <div class="json-wrapper">
                                                        <pre class="json-pre">
                                                                    {{ json_encode(json_decode($item->activity), JSON_PRETTY_PRINT) }}
                                                                </pre>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Created Time</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Updated At</td>
                                                <td>{{ $item->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <h4>Di View Pada :</h4>
                                    <div>
                                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm [WIB]') }}
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
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
                        className: 'btn bg-blue-lt btn-md',
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
                    "url": "{{ route('getLogs.index') }}",
                    // "data": function(data) {
                    //     data._token = "{{ csrf_token() }}";
                    //     data.dari = $('#filterStart-all').val();
                    //     data.sampai = $('#filterEnd-all').val();
                    //     data.status = '*';
                    // }
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
                        title: 'Tanggal',
                        data: 'created_at',
                        name: 'created_at',
                        className: "cuspad0 cuspad1 text-center",
                        render: function(data, type, row) {
                            return moment(data).format('D MMMM YYYY HH:mm [WIB]');
                        }
                    },
                    {
                        title: 'IP Address',
                        data: 'ip_address',
                        name: 'ip_address',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'Method',
                        data: 'method',
                        name: 'method',
                        className: "cuspad0 cuspad1 text-center"
                    },
                    {
                        title: 'Path',
                        data: 'path',
                        name: 'path',
                        className: "cuspad0 cuspad1 text-center"
                    },
                ],
            });
            const modal = document.getElementById('modal-hapus');
            const deleteForm = document.getElementById('delete-form');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const recordId = button.getAttribute('data-id');
                deleteForm.action = `/logs/destroy/${recordId}`;
            });
        });
    </script>
@endsection
