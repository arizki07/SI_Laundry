@if ($pengeluarans->count())
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>No Pengeluaran</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengeluarans as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $p->no_pengeluaran }}</td>
                        <td>{{ $p->kategori_pengeluaran }}</td>
                        <td>Rp{{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-red-lt">{{ $p->metode_pembayaran }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pengeluaran)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning text-center">
        Tidak ada data pengeluaran pada periode tersebut.
    </div>
@endif
