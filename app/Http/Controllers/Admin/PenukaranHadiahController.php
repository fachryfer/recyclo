<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenukaranHadiah;
use App\Models\Nasabah;
use App\Models\Hadiah;
use App\Models\PoinNasabah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenukaranHadiahController extends Controller
{
    public function index()
    {
        $penukaranHadiah = PenukaranHadiah::with(['nasabah', 'hadiah'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.admin.penukaran_hadiah.index', compact('penukaranHadiah'));
    }

    public function setujui(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $penukaran = PenukaranHadiah::with(['nasabah.poinNasabah', 'hadiah'])->findOrFail($id);
            
            if ($penukaran->status !== 'pending') {
                return redirect()->back()->with('error', 'Status penukaran tidak valid');
            }

            // Cek apakah nasabah memiliki poin yang cukup
            if (!$penukaran->nasabah->poinNasabah || $penukaran->nasabah->poinNasabah->jumlah_poin < $penukaran->hadiah->jumlah_poin) {
                return redirect()->back()->with('error', 'Poin nasabah tidak mencukupi');
            }

            // Upload gambar
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $namaGambar = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('public/penukaran_hadiah', $namaGambar);
                
                // Update status dan gambar penukaran
                $penukaran->status = 'disetujui';
                $penukaran->tanggal_proses = now();
                $penukaran->gambar = $namaGambar;
                $penukaran->save();

                // Kurangi poin nasabah
                $poinNasabah = $penukaran->nasabah->poinNasabah;
                $poinNasabah->jumlah_poin -= $penukaran->hadiah->jumlah_poin;
                $poinNasabah->tanggal_update = now();
                $poinNasabah->save();

                // Kurangi stok hadiah
                $hadiah = $penukaran->hadiah;
                $hadiah->stok -= 1;
                $hadiah->save();

                DB::commit();
                return redirect()->back()->with('success', 'Penukaran hadiah berhasil disetujui');
            }

            return redirect()->back()->with('error', 'Gambar harus diunggah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255'
        ]);

        $penukaran = PenukaranHadiah::findOrFail($id);
        
        if ($penukaran->status !== 'pending') {
            return redirect()->back()->with('error', 'Status penukaran tidak valid');
        }

        $penukaran->status = 'ditolak';
        $penukaran->keterangan = $request->keterangan;
        $penukaran->save();

        return redirect()->back()->with('success', 'Penukaran hadiah berhasil ditolak');
    }

    public function create()
    {
        $nasabah = Nasabah::all();
        $hadiah = Hadiah::where('status', 'aktif')->get();
        return view('pages.admin.penukaran_hadiah.create', compact('nasabah', 'hadiah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'hadiah_id' => 'required|exists:hadiah,id',
            'keterangan' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $hadiah = Hadiah::findOrFail($request->hadiah_id);
            $nasabah = Nasabah::with('poinNasabah')->findOrFail($request->nasabah_id);
            $poinNasabah = $nasabah->poinNasabah;

            // Cek stok hadiah
            if ($hadiah->stok <= 0) {
                return redirect()->back()
                    ->with('error', 'Maaf, stok hadiah ini sudah habis');
            }

            // Cek apakah nasabah memiliki poin yang cukup
            if (!$poinNasabah || $poinNasabah->jumlah_poin < $hadiah->jumlah_poin) {
                return redirect()->back()
                    ->with('error', 'Poin nasabah tidak mencukupi. Poin yang dibutuhkan: ' . number_format($hadiah->jumlah_poin, 0, ',', '.') . ', Poin nasabah: ' . number_format($poinNasabah ? $poinNasabah->jumlah_poin : 0, 0, ',', '.'));
            }

            // Cek apakah nasabah memiliki pengajuan yang pending
            $pendingRequest = PenukaranHadiah::where('nasabah_id', $request->nasabah_id)
                ->where('status', 'pending')
                ->first();

            if ($pendingRequest) {
                return redirect()->back()
                    ->with('error', 'Nasabah masih memiliki pengajuan penukaran hadiah yang pending');
            }

            // Buat pengajuan penukaran hadiah
            PenukaranHadiah::create([
                'nasabah_id' => $request->nasabah_id,
                'hadiah_id' => $request->hadiah_id,
                'jumlah_poin' => $hadiah->jumlah_poin,
                'status' => 'pending',
                'keterangan' => $request->keterangan,
                'tanggal_pengajuan' => now()
            ]);

            DB::commit();
            return redirect()->route('admin.penukaran-hadiah')
                ->with('success', 'Pengajuan penukaran hadiah berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateGambar(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $penukaran = PenukaranHadiah::findOrFail($id);
            
            if ($penukaran->status !== 'disetujui') {
                return redirect()->back()->with('error', 'Hanya penukaran yang sudah disetujui yang dapat diubah gambarnya');
            }

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($penukaran->gambar) {
                    Storage::delete('public/penukaran_hadiah/' . $penukaran->gambar);
                }

                // Upload gambar baru
                $gambar = $request->file('gambar');
                $namaGambar = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('public/penukaran_hadiah', $namaGambar);
                
                // Update data penukaran
                $penukaran->gambar = $namaGambar;
                $penukaran->save();

                DB::commit();
                return redirect()->back()->with('success', 'Gambar penukaran berhasil diperbarui');
            }

            return redirect()->back()->with('error', 'Gambar harus diunggah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteGambar($id)
    {
        DB::beginTransaction();
        try {
            $penukaran = PenukaranHadiah::findOrFail($id);
            
            if ($penukaran->status !== 'disetujui') {
                return redirect()->back()->with('error', 'Hanya penukaran yang sudah disetujui yang dapat dihapus gambarnya');
            }

            if ($penukaran->gambar) {
                // Hapus file gambar
                Storage::delete('public/penukaran_hadiah/' . $penukaran->gambar);
                
                // Update data penukaran
                $penukaran->gambar = null;
                $penukaran->save();

                DB::commit();
                return redirect()->back()->with('success', 'Gambar penukaran berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Tidak ada gambar untuk dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
} 