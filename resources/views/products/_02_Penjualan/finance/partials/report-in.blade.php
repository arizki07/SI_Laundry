@if ($sales->count())
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>No Resi</th>
                    <th>No Invoice</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $s->no_resi }}</td>
                        <td>{{ $s->no_invoice }}</td>
                        <td>Rp{{ number_format($s->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $s->metode_pembayaran }}</td>
                        <td>
                            @if ($s->status_pembayaran == 'lunas')
                                <span class="badge bg-green-lt">Lunas</span>
                            @else
                                <span class="badge bg-red-lt">Pending</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning text-center">
        Tidak ada data pemasukan pada periode tersebut.
    </div>
@endif
