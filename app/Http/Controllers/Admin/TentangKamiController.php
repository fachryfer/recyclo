<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TentangKami;
use RealRashid\SweetAlert\Facades\Alert;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangKami = TentangKami::first();
        return view('pages.admin.tentang_kami.index', compact('tentangKami'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_tentang_kami' => 'required|string',
        ]);

        TentangKami::create([
            'isi_tentang_kami' => $request->isi_tentang_kami,
        ]);

        Alert::success('Hore!', 'Data Tentang Kami berhasil ditambahkan!')->autoclose(3000);
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_tentang_kami' => 'required|string',
        ]);

        $tentangKami = TentangKami::findOrFail($id);
        $tentangKami->update([
            'isi_tentang_kami' => $request->isi_tentang_kami,
        ]);

        Alert::success('Hore!', 'Data Tentang Kami berhasil diperbarui!')->autoclose(3000);
        return redirect()->back();
    }
}
