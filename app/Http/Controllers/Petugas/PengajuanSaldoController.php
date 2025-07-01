<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Nasabah;

class PengajuanSaldoController extends Controller
{
    public function create()
    {
        $nasabah = Nasabah::all();

        $pengajuanSaldo = PencairanSaldo::with('nasabah')
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('pages.petugas.pengajuan_saldo.create', compact('nasabah', 'pengajuanSaldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'metode_pencairan' => 'required|in:tunai,transfer,dana,ovo,gopay,shopeepay',
            'jumlah_pencairan' => 'required|numeric|min:1000',
            'no_rek' => 'required_unless:metode_pencairan,tunai',
        ]);

        // Cek apakah nasabah sudah punya pengajuan yang masih pending
        $sudahAdaPengajuan = PencairanSaldo::where('nasabah_id', $request->nasabah_id)
            ->where('status', 'pending')
            ->exists();

        if ($sudahAdaPengajuan) {
            return redirect()->back()
                ->withErrors(['nasabah_id' => 'Nasabah ini masih memiliki pengajuan yang sedang diproses.'])
                ->withInput();
        }

        PencairanSaldo::create([
            'nasabah_id' => $request->nasabah_id,
            'metode_pencairan' => $request->metode_pencairan,
            'no_rek' => $request->no_rek ?? null,
            'jumlah_pencairan' => $request->jumlah_pencairan,
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.pengajuan_saldo.create')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
