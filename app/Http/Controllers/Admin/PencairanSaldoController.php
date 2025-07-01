<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Saldo;

class PencairanSaldoController extends Controller
{
    public function index()
    {
        $pencairanSaldo = PencairanSaldo::with(['nasabah', 'metode'])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);
        return view('pages.admin.pencairan_saldo.index', compact('pencairanSaldo'));
    }

    public function setujui(Request $request, $id)
    {
        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return back()->withErrors(['msg' => 'Permintaan sudah diproses.']);
        }

        $saldo = Saldo::where('nasabah_id', $pencairan->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $pencairan->jumlah_pencairan) {
            return back()->withErrors(['msg' => 'Saldo tidak mencukupi.']);
        }

        $saldo->saldo -= $pencairan->jumlah_pencairan;
        $saldo->save();

        $pencairan->status = 'disetujui';
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return back()->withErrors(['msg' => 'Permintaan sudah diproses.']);
        }

        $pencairan->status = 'ditolak';
        $pencairan->keterangan = $request->keterangan;
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return back()->with('error', 'Pengajuan ditolak.');
    }

    
}


