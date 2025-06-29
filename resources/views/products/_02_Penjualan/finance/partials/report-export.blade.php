<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            margin: 40px 50px 70px 50px; /* ruang bawah lebih banyak untuk footer */
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 22px;
            color: #2c3e50;
        }

        .periode {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #dfe3e8;
        }

        thead {
            background-color: #f1f5f9;
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #dfe3e8;
        }

        th {
            background-color: #f6f9fc;
            text-align: left;
            font-weight: 600;
        }

        td.text-right {
            text-align: right;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .total-row {
            background-color: #e6f4ff;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            font-size: 11px;
            color: #777;
            padding: 0 50px;
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>
<body>

    <h2>Laporan Keuangan</h2>
    <div class="periode">
        Periode: <strong>{{ $start->format('d M Y') }}</strong> – <strong>{{ $end->format('d M Y') }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 70%;">Keterangan</th>
                <th style="width: 30%;" class="text-right">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jumlah Transaksi Pemasukan</td>
                <td class="text-right">{{ $jumlahPemasukan }}</td>
            </tr>
            <tr>
                <td>Jumlah Transaksi Pengeluaran</td>
                <td class="text-right">{{ $jumlahPengeluaran }}</td>
            </tr>
            <tr>
                <td>Total Pemasukan</td>
                <td class="text-right">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td class="text-right">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keuntungan</td>
                <td class="text-right">Rp{{ number_format($keuntungan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kerugian</td>
                <td class="text-right">Rp{{ number_format($kerugian, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Akhir</td>
                <td class="text-right">Rp{{ number_format($totalAkhir, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="left">Dicetak: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</div>
        <div class="right">Copyright © 2025 Indah Laundry. Semua hak dilindungi.</div>
    </div>

</body>
</html>
