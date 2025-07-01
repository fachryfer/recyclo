<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenukaranHadiah;
use App\Models\Hadiah;
use App\Models\PoinNasabah;
use Illuminate\Support\Facades\DB;

class PenukaranHadiahController extends Controller
{
    public function index()
    {
        // Ambil data hadiah yang aktif dan memiliki stok
        $hadiah = Hadiah::where('status', 'aktif')
            ->where('stok', '>', 0)
            ->get();

        // Ambil riwayat penukaran hadiah nasabah
        $riwayatPenukaran = PenukaranHadiah::with(['hadiah'])
            ->where('nasabah_id', session('nasabah_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        $sampahs = \App\Models\Sampah::whereNotNull('gambar')->get();

        return view('pages.nasabah.penukaran_hadiah', compact('hadiah', 'riwayatPenukaran', 'sampahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hadiah_id' => 'required|exists:hadiah,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $hadiah = Hadiah::findOrFail($request->hadiah_id);
            $nasabahPoin = PoinNasabah::where('nasabah_id', session('nasabah_id'))->first();

            // Cek stok hadiah
            if ($hadiah->stok <= 0) {
                return redirect()->back()
                    ->with('error', 'Maaf, stok hadiah ini sudah habis');
            }

            // Cek apakah nasabah memiliki poin yang cukup untuk jumlah yang diajukan
            $totalPoinDibutuhkan = $hadiah->jumlah_poin * $request->jumlah;
            if (!$nasabahPoin || $nasabahPoin->jumlah_poin < $totalPoinDibutuhkan) {
                $hadiah = Hadiah::where('status', 'aktif')->where('stok', '>', 0)->get();
                $riwayatPenukaran = PenukaranHadiah::with(['hadiah'])
                    ->where('nasabah_id', session('nasabah_id'))
                    ->orderBy('created_at', 'desc')
                    ->get();
                return view('pages.nasabah.penukaran_hadiah', [
                    'hadiah' => $hadiah,
                    'riwayatPenukaran' => $riwayatPenukaran,
                    'error' => 'Poin Anda tidak mencukupi. Poin yang dibutuhkan: ' . number_format($totalPoinDibutuhkan, 0, ',', '.') . ', Poin Anda: ' . number_format($nasabahPoin ? $nasabahPoin->jumlah_poin : 0, 0, ',', '.'),
                ]);
            }

            // Cek apakah nasabah memiliki pengajuan yang pending
            $pendingRequest = PenukaranHadiah::where('nasabah_id', session('nasabah_id'))
                ->where('status', 'pending')
                ->first();

            if ($pendingRequest) {
                // dd('pending', $pendingRequest);
                $hadiah = Hadiah::where('status', 'aktif')->where('stok', '>', 0)->get();
                $riwayatPenukaran = PenukaranHadiah::with(['hadiah'])
                    ->where('nasabah_id', session('nasabah_id'))
                    ->orderBy('created_at', 'desc')
                    ->get();
                return view('pages.nasabah.penukaran_hadiah', [
                    'hadiah' => $hadiah,
                    'riwayatPenukaran' => $riwayatPenukaran,
                    'error' => 'Anda masih memiliki pengajuan penukaran hadiah yang masih pending',
                ]);
            }

            // Buat pengajuan penukaran hadiah
            PenukaranHadiah::create([
                'nasabah_id' => session('nasabah_id'),
                'hadiah_id' => $request->hadiah_id,
                'jumlah' => $request->jumlah,
                'jumlah_poin' => $hadiah->jumlah_poin,
                'total_poin' => $totalPoinDibutuhkan,
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();
            return redirect()->back()
                ->with('success', 'Pengajuan penukaran hadiah berhasil dibuat. Silakan tunggu persetujuan dari admin.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
} 