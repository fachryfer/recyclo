@extends('layouts.app')

@section('title', 'Detail Pengepul')

@push('style')
    <!-- Tambahkan CSS Libraries jika diperlukan -->
    <style>
        .card-highlight {
            background: #f9f9f9;
            border-left: 5px solid #4caf50;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Pengepul</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail pengepul dan riwayat pengiriman.</h6>
        </div>
        <div class="ms-md-auto mt-3 mt-md-0">
            <a href="{{ route('admin.pengepul.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Informasi Pengepul -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-highlight mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Informasi Pengepul</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Nama Pengepul:</strong> {{ $pengepul->nama }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Alamat:</strong> {{ $pengepul->alamat }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Kontak:</strong> {{ $pengepul->kontak }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pengiriman -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold mb-0">Riwayat Pengiriman ke Pengepul</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengiriman</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Detail Sampah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatPengiriman as $index => $pengiriman)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pengiriman->kode_pengiriman }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pengiriman->tanggal_pengiriman)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($pengiriman->detailPengiriman as $detail)
                                                    <li>
                                                        {{ $detail->sampah->nama_sampah }} -
                                                        {{ $detail->berat_kg }} kg
                                                        (Rp{{ number_format($detail->harga_total, 2) }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            Rp{{ number_format($pengiriman->detailPengiriman->sum('harga_total'), 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pengiriman.</td>
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
    <!-- Tambahkan JS Libraries jika diperlukan -->
@endpush
