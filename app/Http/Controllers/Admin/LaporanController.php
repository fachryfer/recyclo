<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\PencairanSaldo;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporanTransaksi = [];
        $laporanPencairan = [];

        if ($request->filled('jenis_laporan')) {
            $jenisLaporan = $request->input('jenis_laporan');
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');

            if ($jenisLaporan === 'transaksi') {
                $laporanTransaksi = Transaksi::whereBetween('tanggal_transaksi', [$tanggalAwal, $tanggalAkhir])
                    ->with('nasabah', 'petugas')
                    ->get();
            } elseif ($jenisLaporan === 'pencairan') {
                $laporanPencairan = PencairanSaldo::whereBetween('tanggal_pengajuan', [$tanggalAwal, $tanggalAkhir])
                    ->with('nasabah', 'metode')
                    ->get();
            }
        }

        return view('pages.admin.laporan.index', compact('laporanTransaksi', 'laporanPencairan'));
    }

    public function print(Request $request)
    {
        $jenisLaporan = $request->input('jenis_laporan');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $data = [];

        if ($jenisLaporan === 'transaksi') {
            $data = Transaksi::whereBetween('tanggal_transaksi', [$tanggalAwal, $tanggalAkhir])
                ->with('nasabah', 'petugas')
                ->get();
        } elseif ($jenisLaporan === 'pencairan') {
            $data = PencairanSaldo::whereBetween('tanggal_pengajuan', [$tanggalAwal, $tanggalAkhir])
                ->with('nasabah', 'metode')
                ->get();
        }

        return view('pages.admin.laporan.print', compact('data', 'jenisLaporan', 'tanggalAwal', 'tanggalAkhir'));
    }
}
