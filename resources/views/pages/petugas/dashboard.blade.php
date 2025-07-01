@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@push('style')
<style>
    .card-stats .card-body {
        background-color: #f4fdf7;
        border-left: 5px solid #28a745;
        border-radius: 10px;
    }
    .icon-green {
        color: #28a745;
    }
    .card-header {
        background-color: #28a745;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .table-head-bg-primary thead {
        background-color: #28a745;
        color: white;
    }
</style>
@endpush

@section('main')
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Dashboard Petugas</h3>
        <h6 class="op-7 mb-2 text-muted">Ringkasan Data dan Tugas Harian</h6>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-3 mb-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-green bubble-shadow-small">
                            <i class="fas fa-recycle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Nasabah</p>
                            <h4 class="card-title">{{ $totalNasabah }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-green bubble-shadow-small">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Setoran Hari Ini</p>
                            <h4 class="card-title">{{ $totalTransaksiHariIni }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-green bubble-shadow-small">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Sampah Hari Ini</p>
                            <h4 class="card-title">{{ $totalSampahHariIni }} Kg</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-green bubble-shadow-small">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Saldo Nasabah</p>
                            <h4 class="card-title">Rp {{ number_format($totalOmzetHariIni, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RINGKASAN AKTIVITAS MINGGUAN -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Ringkasan Aktivitas Mingguan</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-head-bg-primary">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Sampah (Kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Tambahkan jika ada JS spesifik -->
@endpush
