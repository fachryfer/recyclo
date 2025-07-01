<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengepul;
use App\Models\Sampah;
use App\Models\PengirimanPengepul;
use App\Models\DetailPengiriman;
use Illuminate\Support\Facades\DB;

class PengirimanPengepulController extends Controller
{
    public function index()
    {
        // Ambil data pengiriman sampah dengan relasi ke pengepul
        $pengirimanSampah = PengirimanPengepul::with('pengepul')
            ->paginate(10);

        // Transformasi data langsung pada koleksi paginator
        $pengirimanSampah->getCollection()->transform(function ($pengiriman) {
            // Hitung total berat sampah dalam pengiriman ini
            $pengiriman->total_berat = DetailPengiriman::where('pengiriman_id', $pengiriman->id)
                ->sum('berat_kg');

            // Hitung jumlah jenis sampah yang berbeda dalam pengiriman ini
            $pengiriman->jumlah_jenis_sampah = DetailPengiriman::where('pengiriman_id', $pengiriman->id)
                ->distinct('sampah_id')
                ->count('sampah_id');

            return $pengiriman;
        });

        // Tampilkan ke view
        return view('pages.admin.pengiriman.index', compact('pengirimanSampah'));
    }

    public function generateUniqueShippingCode()
    {
        // Format: BSR-YYYYMMDD-PENG-001
        $today = now()->format('Ymd');
        $prefix = "BSR-{$today}-PENG-";

        // Cari kode pengiriman terakhir hari ini
        $lastShipping = PengirimanPengepul::where('kode_pengiriman', 'like', $prefix . '%')
            ->orderBy('kode_pengiriman', 'desc')
            ->first();

        if (!$lastShipping) {
            // Jika belum ada pengiriman hari ini, mulai dari 001
            return $prefix . '001';
        }

        // Ekstrak nomor urut terakhir
        $lastNumber = substr($lastShipping->kode_pengiriman, -3);
        $newNumber = str_pad((int)$lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }


    public function create()
    {
        $pengepulList = Pengepul::all();
        $kodePengiriman = $this->generateUniqueShippingCode();

        $stokSampah = Sampah::with(['detailTransaksi', 'detailPengiriman'])
            ->get()
            ->map(function ($sampah) {
                $totalSetoran = $sampah->detailTransaksi->sum('berat_kg');
                $totalPengiriman = $sampah->detailPengiriman->sum('berat_kg');
                $sampah->stok = $totalSetoran - $totalPengiriman;
                return $sampah;
            });

        return view('pages.admin.pengiriman.create', compact('pengepulList', 'stokSampah', 'kodePengiriman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengepul_id' => 'required|exists:pengepul,id',
            'tanggal_pengiriman' => 'required|date',
            'sampah_id' => 'required|array',
            'sampah_id.*' => 'exists:sampah,id',
            'berat_kg' => 'required|array',
            'berat_kg.*' => 'numeric|min:0',
            'harga_per_kg' => 'required|array',
            'harga_per_kg.*' => 'numeric|min:1',
        ]);

        try {
            // Buat data pengiriman utama
            $pengiriman = PengirimanPengepul::create([
                'kode_pengiriman' => $request->kode_pengiriman,
                'pengepul_id' => $request->pengepul_id,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
            ]);

            $totalHargaKeseluruhan = 0;

            foreach ($request->sampah_id as $index => $sampahId) {
                $beratPengiriman = $request->berat_kg[$index];
                $hargaPerKg = $request->harga_per_kg[$index];

                // Ambil data stok dinamis
                $stokSampah = Sampah::with(['detailTransaksi', 'detailPengiriman'])->find($sampahId);
                $totalSetoran = $stokSampah->detailTransaksi->sum('berat_kg');
                $totalPengiriman = $stokSampah->detailPengiriman->sum('berat_kg');
                $stokTersedia = $totalSetoran - $totalPengiriman;

                // Validasi stok
                if ($beratPengiriman > $stokTersedia) {
                    return redirect()->back()->withErrors(['error' => "Stok sampah '{$stokSampah->nama_sampah}' tidak mencukupi. Stok tersedia hanya {$stokTersedia} kg."])->withInput();
                }

                // Hitung harga total
                $hargaTotal = $beratPengiriman * $hargaPerKg;
                $totalHargaKeseluruhan += $hargaTotal;

                // Simpan detail pengiriman
                DetailPengiriman::create([
                    'pengiriman_id' => $pengiriman->id,
                    'sampah_id' => $sampahId,
                    'berat_kg' => $beratPengiriman,
                    'harga_per_kg' => $hargaPerKg,
                    'harga_total' => $hargaTotal,
                ]);
            }

            // Update total harga keseluruhan di tabel pengiriman jika diperlukan
            $pengiriman->update(['total_harga' => $totalHargaKeseluruhan]);

            return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data pengiriman: ' . $e->getMessage()])->withInput();
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $pengiriman = PengirimanPengepul::findOrFail($id);
            $pengiriman->details()->delete();  // Menghapus semua detail pengiriman
            $pengiriman->delete();             // Menghapus pengiriman utama

            DB::commit();
            return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pengiriman: ' . $e->getMessage());
        }
    }
}
