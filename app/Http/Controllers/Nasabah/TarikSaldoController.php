<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Nasabah;
use App\Models\PengajuanSaldo;
use App\Models\Sampah;

class TarikSaldoController extends Controller
{
    public function create()
    {
        $nasabah = Nasabah::find(session('nasabah_id'));
        $pengajuanSaldo = PencairanSaldo::with('nasabah')
            ->where('nasabah_id', session('nasabah_id'))
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        $sampahs = Sampah::whereNotNull('gambar')->get();

        return view('pages.nasabah.tarik_saldo', compact('nasabah', 'pengajuanSaldo', 'sampahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pencairan' => 'required|in:tunai,transfer,dana,ovo,gopay,shopeepay',
            'jumlah_pencairan' => 'required|numeric|min:1000',
            'no_rek' => 'required_unless:metode_pencairan,tunai',
        ]);

        // Cek saldo nasabah
        $nasabah = Nasabah::find(session('nasabah_id'));
        if ($nasabah->saldo < $request->jumlah_pencairan) {
            return redirect()->back()
                ->withErrors(['jumlah_pencairan' => 'Saldo tidak mencukupi.'])
                ->withInput();
        }

        // Cek apakah nasabah sudah punya pengajuan yang masih pending
        $sudahAdaPengajuan = PencairanSaldo::where('nasabah_id', session('nasabah_id'))
            ->where('status', 'pending')
            ->exists();

        if ($sudahAdaPengajuan) {
            return redirect()->back()
                ->withErrors(['nasabah_id' => 'Anda masih memiliki pengajuan yang sedang diproses.'])
                ->withInput();
        }

        PencairanSaldo::create([
            'nasabah_id' => session('nasabah_id'),
            'metode_pencairan' => $request->metode_pencairan,
            'no_rek' => $request->no_rek ?? null,
            'jumlah_pencairan' => $request->jumlah_pencairan,
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('nasabah.tarik-saldo')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function index()
    {
        $pengajuanSaldo = PengajuanSaldo::where('nasabah_id', session('nasabah_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        $sampahs = Sampah::whereNotNull('gambar')->get();

        return view('pages.nasabah.tarik_saldo', compact('pengajuanSaldo', 'sampahs'));
    }
} 