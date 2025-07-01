<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Saldo;
use App\Models\Transaksi;
use App\Models\PencairanSaldo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Nasabah::with('saldo');

        if ($request->filled('nama_nasabah')) {
            $query->where('nama_lengkap', 'like', '%' . $request->input('nama_nasabah') . '%');
        }

        $nasabahs = $query->paginate(10);

        return view('pages.petugas.nasabah.index', compact('nasabahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tanggal = Carbon::now()->format('YmdHis');
        $randomNumber = Str::padLeft(mt_rand(0, 9999), 4, '0');
        $nomorRegistrasi = "NSB-{$tanggal}-{$randomNumber}";

        return view('pages.petugas.nasabah.create', compact('nomorRegistrasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|unique:nasabah,no_registrasi',
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'nik' => 'required|digits:16|unique:nasabah,nik',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email', // Mengizinkan email yang sama
            'username' => 'required|string|unique:nasabah,username|max:255',
            'password' => 'required|string|min:8',
        ]);

        $nasabah = Nasabah::create([
            'nama_lengkap' => $request->nama_lengkap,
            'no_registrasi' => $request->no_registrasi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email, // Email tidak perlu unik
            'username' => $request->username,
            'status' => $request->status ?? 'aktif',
            'password' => Hash::make($request->password),
        ]);

        Saldo::create([
            'nasabah_id' => $nasabah->id,
            'saldo' => 0
        ]);

        Alert::success('Berhasil!', 'Nasabah berhasil ditambahkan!')->autoclose(3000);
        return redirect()->route('petugas.nasabah.index');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data nasabah
        $nasabah = Nasabah::findOrFail($id);

        // Ambil riwayat setoran (transaksi)
        $riwayatSetoran = Transaksi::with(['detailTransaksi.sampah'])
            ->where('nasabah_id', $id)
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        // Ambil riwayat penarikan saldo
        $riwayatPenarikan = PencairanSaldo::with('metode')
            ->where('nasabah_id', $id)
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('pages.petugas.nasabah.show', compact('nasabah', 'riwayatSetoran', 'riwayatPenarikan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        return view('pages.petugas.nasabah.edit', compact('nasabah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        $request->validate([
            'no_registrasi' => 'required|unique:nasabah,no_registrasi,' . $nasabah->id,
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'nik' => 'required|digits:16|unique:nasabah,nik,' . $nasabah->id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email',
            'username' => 'required|string|unique:nasabah,username,' . $nasabah->id . '|max:255',
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $nasabah->update([
            'no_registrasi' => $request->no_registrasi,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'username' => $request->username,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $nasabah->password = Hash::make($request->password);
            $nasabah->save();
        }

        Alert::success('Berhasil!', 'Nasabah berhasil diperbarui!')->autoclose(3000);
        return redirect()->route('petugas.nasabah.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        echo "asasa";
        $nasabah->delete();
        $nasabah->saldo()->delete();

        return redirect()->route('petugas.nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}
