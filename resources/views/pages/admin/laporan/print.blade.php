<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan {{ ucfirst($jenisLaporan) }} - {{ \Carbon\Carbon::now()->format('d-m-Y-His') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .details {
            margin-top: 20px;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-style: italic;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>BANK SAMPAH RECYCLO</h1>
        <p class="subtitle">"Bersih Itu Adalah Bagian Dari Imam"</p>

        <div class="details">
            <p><strong>Periode Laporan:</strong> {{ $tanggalAwal }} s/d {{ $tanggalAkhir }}</p>
            <p><strong>Jenis Laporan:</strong> {{ ucfirst($jenisLaporan) }}</p>

            <table>
                <thead>
                    @if ($jenisLaporan === 'transaksi')
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Nasabah</th>
                            <th>Petugas</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total (Rp)</th>
                        </tr>
                    @else
                        <tr>
                            <th>#</th>
                            <th>Nasabah</th>
                            <th>Metode Pencairan</th>
                            <th>Jumlah Pencairan (Rp)</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if ($jenisLaporan === 'transaksi')
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->nasabah->nama_lengkap }}</td>
                                <td>{{ $item->petugas->nama }}</td>
                                <td>{{ $item->tanggal_transaksi }}</td>
                                <td>{{ number_format($item->total_transaksi, 0, ',', '.') }}</td>
                            @else
                                <td>{{ $item->nasabah->nama_lengkap }}</td>
                                <td>{{ $item->metode_pencairan }}</td>
                                <td>{{ number_format($item->jumlah_pencairan, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td>{{ $item->tanggal_pengajuan }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        window.print();
    </script>
</body>

</html>
