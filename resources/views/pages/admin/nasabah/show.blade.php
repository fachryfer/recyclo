@extends('layouts.app')

@section('title', 'Detail Nasabah')

@push('style')
    <style>
        .bg-metode-pencairan {
            background: linear-gradient(135deg, #dff0ea, #e6f7ff);
            color: #333;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .bg-metode-pencairan img {
            width: 20px;
            height: auto;
            display: inline-block;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Nasabah</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail nasabah.</h6>
        </div>
        <div class="ms-md-auto mt-3 mt-md-0">
            <a href="{{ route('admin.nasabah.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Data Nasabah dan Saldo -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Nasabah</div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Nama Nasabah</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->nik }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. HP</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->alamat_lengkap }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <div class="card-title fw-bold">Saldo Tersedia</div>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 text-success fw-bold">Rp{{ number_format($nasabah->saldo->saldo ?? 0, 2, ',', '.') }}</h1>
                </div>
            </div>
            
            <!-- Tambahkan card baru untuk poin reward -->
            <div class="card mt-3">
                <div class="card-header text-center">
                    <div class="card-title fw-bold">Poin Reward</div>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 text-primary fw-bold">{{ number_format($nasabah->poinNasabah->jumlah_poin ?? 0) }} Poin</h1>
                    <p class="text-muted">1 kg sampah = 10 poin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi Setoran -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Riwayat Transaksi Setoran</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Detail Sampah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatSetoran as $index => $transaksi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaksi->kode_transaksi }}</td>
                                        <td>{{ $transaksi->tanggal_transaksi }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($transaksi->detailTransaksi as $detail)
                                                    <li>{{ $detail->sampah->nama_sampah }} - {{ $detail->berat_kg }} kg (Rp{{ number_format($detail->harga_total, 2, ',', '.') }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada Transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Penarikan Saldo -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Riwayat Penarikan Saldo</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jumlah</th>
                                    <th>Metode Pencairan</th>
                                    <th>No Rekening</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatPenarikan as $index => $penarikan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($penarikan->tanggal_pengajuan)->format('d-m-Y H:i') }}</td>
                                        <td>Rp{{ number_format($penarikan->jumlah_pencairan, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="bg-metode-pencairan">
                                                @php
                                                    $logoFile = 'tunai.png';
                                                    $metode = strtolower($penarikan->metode_pencairan);

                                                    if (str_contains($metode, 'bank') || $metode === 'transfer') {
                                                        $logoFile = 'bank.png';
                                                    } elseif ($metode === 'ovo') {
                                                        $logoFile = 'ovo.png';
                                                    } elseif ($metode === 'dana') {
                                                        $logoFile = 'dana.png';
                                                    } elseif ($metode === 'gopay') {
                                                        $logoFile = 'gopay.png';
                                                    } elseif ($metode === 'shopeepay') {
                                                        $logoFile = 'shopeepay.png';
                                                    }
                                                @endphp
                                                <img src="{{ asset('assets/img/metode/' . $logoFile) }}" alt="{{ $penarikan->metode_pencairan }}">
                                                {{ ucfirst($penarikan->metode_pencairan) }}
                                            </span>
                                        </td>
                                        <td>{{ $penarikan->no_rek ?? '-' }}</td>
                                        <td>{{ $penarikan->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($penarikan->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($penarikan->status == 'disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada Transaksi Penarikan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
