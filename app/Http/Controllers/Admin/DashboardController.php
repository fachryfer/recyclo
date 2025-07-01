<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\Sampah;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Saldo;
use App\Models\Artikel;
use App\Models\Feedback;
use App\Models\PencairanSaldo;
use App\Models\PengirimanPengepul;
use App\Models\DetailPengiriman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNasabah = Nasabah::count();
        $totalPetugas = Petugas::count();
        $totalSampahTerkumpul = DetailTransaksi::sum('berat_kg');
        $totalTransaksiSetoran = Transaksi::count();
        $totalSaldoNasabah = Saldo::sum('saldo');
        $totalPermintaanPencairan = PencairanSaldo::where('status', 'pending')->count();
        $totalFeedbackMasuk = Feedback::count();
        $totalArtikel = Artikel::count();

        // Tambahan baru
        $totalStokSampah = Sampah::with(['detailTransaksi', 'detailPengiriman'])
            ->get()
            ->sum(function ($sampah) {
                $totalMasuk = $sampah->detailTransaksi->sum('berat_kg');
                $totalKeluar = $sampah->detailPengiriman->sum('berat_kg');
                return $totalMasuk - $totalKeluar;
            });

        $totalSampahTerkirim = DetailPengiriman::sum('berat_kg');

        $totalKeuntungan = DetailPengiriman::get()->sum(function ($detail) {
            return ($detail->harga_per_kg - $detail->harga_beli) * $detail->berat_kg;
        });


        $nasabahTerbaik = Nasabah::withCount(['transaksi as total_setoran' => function ($query) {
            $query->where('tanggal_transaksi', '>=', now()->subMonth());
        }])->orderBy('total_setoran', 'desc')->take(10)->get();

        // Data grafik: setoran sampah per bulan (12 bulan terakhir)
        $setoranPerBulan = [];
        $transaksiPerBulan = [];
        $bulanLabels = [];
        for ($i = 0; $i < 12; $i++) {
            $bulan = now()->subMonths(11 - $i);
            $bulanLabels[] = $bulan->format('M Y');
            $total = \App\Models\DetailTransaksi::whereHas('transaksi', function($q) use ($bulan) {
                $q->whereYear('tanggal_transaksi', $bulan->year)
                  ->whereMonth('tanggal_transaksi', $bulan->month);
            })->sum('berat_kg');
            $setoranPerBulan[] = round($total, 2); // dalam Kg
            $transaksiPerBulan[] = \App\Models\Transaksi::whereYear('tanggal_transaksi', $bulan->year)
                ->whereMonth('tanggal_transaksi', $bulan->month)
                ->count();
        }

        return view('pages.admin.dashboard', compact(
            'totalNasabah',
            'totalPetugas',
            'totalSampahTerkumpul',
            'totalTransaksiSetoran',
            'totalSaldoNasabah',
            'totalPermintaanPencairan',
            'totalFeedbackMasuk',
            'totalArtikel',
            'totalStokSampah',
            'totalSampahTerkirim',
            'totalKeuntungan',
            'nasabahTerbaik',
            'bulanLabels',
            'setoranPerBulan',
            'transaksiPerBulan'
        ));
    }
}
