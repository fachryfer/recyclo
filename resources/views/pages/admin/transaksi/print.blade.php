<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Transaksi</title>
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
        }

        .details {
            margin-top: 20px;
            text-align: left;
        }

        .footer {
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>BANK SAMPAH RECYCLO</h1>
        <p><strong>Tanggal Transaksi:</strong> {{ $tanggal_transaksi }}</p>

        <div class="details">
            <p><strong>Nasabah:</strong> {{ $nasabah->nama_lengkap }}</p>
            <p><strong>Petugas:</strong> {{ $petugas->nama }}</p>

            <table border="1" width="100%" cellpadding="5" cellspacing="0" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Harga per kg (Rp)</th>
                        <th>Subtotal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->sampah->nama_sampah }}</td>
                            <td>{{ $detail->berat_kg }}</td>
                            <td>{{ number_format($detail->harga_per_kg, 0, ',', '.') }}</td>
                            <td>{{ number_format($detail->berat_kg * $detail->harga_per_kg, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Total Transaksi</strong></td>
                        <td>
                            <strong>
                                {{ number_format(
                                    $details->sum(function ($detail) {
                                        return $detail->berat_kg * $detail->harga_per_kg;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Total Berat</strong></td>
                        <td><strong>{{ number_format($total_berat, 2) }} kg</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Poin yang Didapat</strong></td>
                        <td><strong>{{ number_format($poin_didapat) }} poin</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Terima kasih telah berkontribusi dalam menjaga lingkungan.</p>
            <p>"Sampahmu, Masa Depan Kita"</p>
        </div>
    </div>
    <script>
        window.print();

        setTimeout(function() {
            window.location.href =
                "{{ route('admin.transaksi.create') }}";
        }, 5000);
    </script>
</body>

</html>
