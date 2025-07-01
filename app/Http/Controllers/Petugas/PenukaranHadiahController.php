<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PenukaranHadiah;
use App\Models\PoinNasabah;
use Illuminate\Http\Request;

class PenukaranHadiahController extends Controller
{
    public function index()
    {
        $penukaran = PenukaranHadiah::with(['nasabah', 'hadiah'])->get();
        return view('pages.petugas.penukaran.index', compact('penukaran'));
    }

    public function prosesPenukaran($id, Request $request)
    {
        $penukaran = PenukaranHadiah::findOrFail($id);
        
        if ($request->status === 'disetujui') {
            // Kurangi poin nasabah
            $poinNasabah = PoinNasabah::where('nasabah_id', $penukaran->nasabah_id)->first();
            $poinNasabah->jumlah_poin -= $penukaran->jumlah_poin;
            $poinNasabah->save();
            
            // Kurangi stok hadiah
            $hadiah = $penukaran->hadiah;
            $hadiah->stok -= 1;
            $hadiah->save();
        }
        
        $penukaran->status = $request->status;
        $penukaran->keterangan = $request->keterangan;
        $penukaran->tanggal_proses = now();
        $penukaran->save();
        
        return redirect()->back()->with('success', 'Status penukaran berhasil diperbarui');
    }
}