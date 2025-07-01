<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\NasabahController as AdminNasabahController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\SampahController as AdminSampahController;
use App\Http\Controllers\Admin\PengepulController as AdminPengepulController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\AplikasiAndroidController as AdminAplikasiAndroidController;
use App\Http\Controllers\Admin\TokenWhatsAppController as AdminTokenWhatsAppController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PencairanSaldoController as AdminTarikSaldoController;
use App\Http\Controllers\Admin\PengirimanPengepulController as AdminPengirimanPengepulController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\HadiahController as AdminHadiahController;
use App\Http\Controllers\Admin\PenukaranHadiahController as AdminPenukaranHadiahController;

// Petugas Controllers
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\TransaksiController as PetugasTransaksiController;
use App\Http\Controllers\Petugas\NasabahController as PetugasNasabahController;
use App\Http\Controllers\Petugas\PengajuanSaldoController;
use App\Http\Controllers\Petugas\PenukaranHadiahController as PetugasPenukaranHadiahController;

// Root welcome
Route::get('/', function () {
    $sampahs = \App\Models\Sampah::all();
    return view('welcome', compact('sampahs'));
})->name('welcome');

// Login & Logout Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ================= ADMIN =================
Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Data Master
    Route::resource('data-nasabah', AdminNasabahController::class)->names('nasabah');
    Route::resource('data-petugas', AdminPetugasController::class)->except(['show'])->names('petugas');
    Route::resource('data-sampah', AdminSampahController::class)->names('sampah');
    Route::resource('data-pengepul', AdminPengepulController::class)->names('pengepul');

    // Manajemen Konten
    Route::resource('data-banner', AdminBannerController::class)->names('banner');
    Route::resource('data-artikel', AdminArtikelController::class)->names('artikel');

    // Transaksi
    Route::resource('transaksi', AdminTransaksiController::class)->names('transaksi');
    Route::get('transaksi/print/{transaksi}', [AdminTransaksiController::class, 'print'])->name('transaksi.print');

    // Laporan
    Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/print', [AdminLaporanController::class, 'print'])->name('laporan.print');

    // Penarikan Saldo
    Route::get('tarik-saldo', [AdminTarikSaldoController::class, 'index'])->name('tarik-saldo.index');
    Route::post('tarik-saldo/{id}/setujui', [AdminTarikSaldoController::class, 'setujui'])->name('tarik-saldo.setujui');
    Route::post('tarik-saldo/{id}/tolak', [AdminTarikSaldoController::class, 'tolak'])->name('tarik-saldo.tolak');
    

    // Pengiriman Sampah ke Pengepul
    Route::resource('pengiriman/sampah', AdminPengirimanPengepulController::class)->names('pengiriman');

    // Pengaturan
    Route::get('token-whatsapp', [AdminTokenWhatsAppController::class, 'index'])->name('token-whatsapp.index');
    Route::post('token-whatsapp', [AdminTokenWhatsAppController::class, 'update'])->name('token-whatsapp.update');
    Route::resource('update-apk', AdminAplikasiAndroidController::class)->names('aplikasi');
    Route::get('tentang-kami', [TentangKamiController::class, 'index'])->name('tentang_kami.index');
    Route::post('tentang-kami', [TentangKamiController::class, 'store'])->name('tentang_kami.store');
    Route::put('tentang-kami/update/{id}', [TentangKamiController::class, 'update'])->name('tentang_kami.update');

    // Feedback
    Route::resource('data-feedback', AdminFeedbackController::class)->names('feedback');

    // Routes untuk Hadiah
    Route::resource('data-hadiah', AdminHadiahController::class)->names('hadiah');

    // Penukaran Hadiah Routes
    Route::get('/penukaran-hadiah', [AdminPenukaranHadiahController::class, 'index'])->name('penukaran-hadiah');
    Route::get('/penukaran-hadiah/create', [AdminPenukaranHadiahController::class, 'create'])->name('penukaran-hadiah.create');
    Route::post('/penukaran-hadiah/store', [AdminPenukaranHadiahController::class, 'store'])->name('penukaran-hadiah.store');
    Route::post('/penukaran-hadiah/{id}/setujui', [AdminPenukaranHadiahController::class, 'setujui'])->name('penukaran-hadiah.setujui');
    Route::post('/penukaran-hadiah/{id}/tolak', [AdminPenukaranHadiahController::class, 'tolak'])->name('penukaran-hadiah.tolak');
    Route::put('/penukaran-hadiah/{id}/update-gambar', [AdminPenukaranHadiahController::class, 'updateGambar'])->name('penukaran-hadiah.update-gambar');
    Route::delete('/penukaran-hadiah/{id}/delete-gambar', [AdminPenukaranHadiahController::class, 'deleteGambar'])->name('penukaran-hadiah.delete-gambar');
});

// ================= PETUGAS =================
Route::middleware(['auth', 'checkRole:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

    // Data Master
    Route::resource('data-nasabah', PetugasNasabahController::class)->names('nasabah');

    // Transaksi
    Route::resource('transaksi', PetugasTransaksiController::class)->names('transaksi');
    Route::get('transaksi/print/{transaksi}', [PetugasTransaksiController::class, 'print'])->name('transaksi.print');

    // Pengajuan Saldo
        Route::get('pengajuan-saldo/create', [PengajuanSaldoController::class, 'create'])->name('pengajuan_saldo.create');
        Route::post('pengajuan-saldo/store', [PengajuanSaldoController::class, 'store'])->name('pengajuan_saldo.store');

    // Routes untuk Penukaran Hadiah
    Route::get('penukaran-hadiah', [PetugasPenukaranHadiahController::class, 'index'])->name('penukaran-hadiah.index');
    Route::post('penukaran-hadiah/{id}/proses', [PetugasPenukaranHadiahController::class, 'prosesPenukaran'])->name('penukaran-hadiah.proses');
});

Route::middleware(['nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', [App\Http\Controllers\Nasabah\DashboardController::class, 'index'])->name('nasabah.dashboard');
    Route::get('/nasabah/tarik-saldo', [App\Http\Controllers\Nasabah\TarikSaldoController::class, 'create'])->name('nasabah.tarik-saldo');
    Route::post('/nasabah/tarik-saldo', [App\Http\Controllers\Nasabah\TarikSaldoController::class, 'store'])->name('nasabah.tarik-saldo.store');

    // Penukaran Hadiah
    Route::get('/nasabah/penukaran-hadiah', [App\Http\Controllers\Nasabah\PenukaranHadiahController::class, 'index'])->name('nasabah.penukaran-hadiah.index');
    Route::post('/nasabah/penukaran-hadiah', [App\Http\Controllers\Nasabah\PenukaranHadiahController::class, 'store'])->name('nasabah.penukaran-hadiah.store');
});
