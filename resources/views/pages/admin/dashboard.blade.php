@extends('layouts.app')

@section('title', 'Dashboard')

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
    .d-flex > div > h3 {
        font-weight: 700;
    }
    .op-7 {
        opacity: 0.7;
    }
</style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <h6 class="op-7 mb-2 text-muted">Rincian Data dan Transaksi Bank Sampah</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-green bubble-shadow-small">
                                <i class="fas fa-users"></i>
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
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Petugas</p>
                                <h4 class="card-title">{{ $totalPetugas }}</h4>
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
                                <i class="fas fa-recycle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Sampah</p>
                                <h4 class="card-title">{{ $totalSampahTerkumpul }} Kg</h4>
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
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Transaksi Setoran</p>
                                <h4 class="card-title">{{ $totalTransaksiSetoran }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris kedua -->
    <div class="row">
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
                                <p class="card-category">Total Saldo Nasabah</p>
                                <h4 class="card-title">Rp {{ number_format($totalSaldoNasabah, 0, ',', '.') }}</h4>
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
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Permintaan Tarik Saldo</p>
                                <h4 class="card-title">{{ $totalPermintaanPencairan }}</h4>
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
                                <i class="fas fa-comment-dots"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Feedback Masuk</p>
                                <h4 class="card-title">{{ $totalFeedbackMasuk }}</h4>
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
                                <i class="fas fa-newspaper"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Artikel</p>
                                <h4 class="card-title">{{ $totalArtikel }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris ketiga -->
    <div class="row">
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
                                <p class="card-category">Total Stok Sampah</p>
                                <h4 class="card-title">{{ $totalStokSampah }} Kg</h4>
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
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Sampah Terkirim</p>
                                <h4 class="card-title">{{ $totalSampahTerkirim }} Kg</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 mb-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-green bubble-shadow-small">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Keuntungan Bank Sampah</p>
                                <h4 class="card-title">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik dalam 1 row 2 kolom -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white d-flex align-items-center gap-2">
                    <i class="bi bi-recycle" style="font-size:1.5rem;"></i>
                    <h5 class="mb-0">Statistik Setoran Sampah per Bulan</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartSetoranSampah" height="180"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white d-flex align-items-center gap-2">
                    <i class="bi bi-graph-up" style="font-size:1.5rem;"></i>
                    <h5 class="mb-0">Jumlah Transaksi Setoran per Bulan</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTransaksiSetoran" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulan = @json($bulanLabels);
        const dataSetoran = @json($setoranPerBulan);
        const dataTransaksi = @json($transaksiPerBulan);
        // Bar chart: Setoran Sampah
        const ctx = document.getElementById('chartSetoranSampah').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Setoran Sampah (Kg)',
                    data: dataSetoran,
                    backgroundColor: 'rgba(68, 187, 95, 0.7)',
                    borderColor: 'rgba(68, 187, 95, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#44bb5f', font: { weight: 'bold' } }
                    },
                    x: {
                        ticks: { color: '#44bb5f', font: { weight: 'bold' } }
                    }
                }
            }
        });
        // Line chart: Transaksi Setoran
        const ctxLine = document.getElementById('chartTransaksiSetoran').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: dataTransaksi,
                    fill: true,
                    borderColor: 'rgba(68, 187, 95, 1)',
                    backgroundColor: 'rgba(68, 187, 95, 0.15)',
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(68, 187, 95, 1)',
                    pointRadius: 4,
                    borderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#44bb5f', font: { weight: 'bold' } }
                    },
                    x: {
                        ticks: { color: '#44bb5f', font: { weight: 'bold' } }
                    }
                }
            }
        });
    </script>
@endpush
