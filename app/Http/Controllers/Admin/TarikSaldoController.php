<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;

class AdminTarikSaldoController extends Controller
{
    public function index()
    {
        $pencairanSaldo = PencairanSaldo::with('nasabah')->where('status', 'pending')->paginate(10);
        return view('pages.admin.tarik_saldo.index', compact('pencairanSaldo'));
    }

    public function setujui($id)
    {
        $pencairan = PencairanSaldo::findOrFail($id);
        $pencairan->update(['status' => 'disetujui']);
        return redirect()->route('admin.tarik-saldo.index')->with('success', 'Pengajuan disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate(['keterangan' => 'required']);
        $pencairan = PencairanSaldo::findOrFail($id);
        $pencairan->update([
            'status' => 'ditolak',
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('admin.tarik-saldo.index')->with('success', 'Pengajuan ditolak.');
    }
}
