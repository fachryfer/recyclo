@extends('layouts.app')

@section('title', 'Detail Transaksi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Transaksi</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail transaksi.</h6>
        </div>
        <div class="ms-md-auto mt-3 mt-md-0">
            <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Data Transaksi -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Informasi Transaksi</div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Kode Transaksi</strong></td>
                            <td>:</td>
                            <td>{{ $transaksi->kode_transaksi }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Transaksi</strong></td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Nasabah</strong></td>
                            <td>:</td>
                            <td>{{ $transaksi->nasabah->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kontak Nasabah</strong></td>
                            <td>:</td>
                            <td>{{ $transaksi->nasabah->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Transaksi</strong></td>
                            <td>:</td>
                            <td>Rp{{ number_format($transaksi->total_harga, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Sampah -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Sampah</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sampah</th>
                                    <th>Berat (kg)</th>
                                    <th>Harga/Kg</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($detailTransaksi as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->sampah->nama_sampah }}</td>
                                        <td>{{ $detail->berat_kg }}</td>
                                        <td>Rp{{ number_format($detail->harga_per_kg, 2) }}</td>
                                        <td>Rp{{ number_format($detail->harga_total, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">Belum ada detail sampah.</div>
                                        </td>
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
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
