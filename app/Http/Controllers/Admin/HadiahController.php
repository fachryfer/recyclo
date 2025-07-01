<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HadiahController extends Controller
{
    public function index()
    {
        $hadiah = Hadiah::all();
        return view('pages.admin.hadiah.index', compact('hadiah'));
    }

    public function create()
    {
        return view('pages.admin.hadiah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hadiah' => 'required',
            'deskripsi' => 'required',
            'jumlah_poin' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('hadiah', $namaGambar, 'public');
            $data['gambar'] = $path;
        }

        Hadiah::create($data);
        return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil ditambahkan');
    }

    public function edit($id)
{
    $hadiah = Hadiah::findOrFail($id);
    return view('pages.admin.hadiah.edit', compact('hadiah'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_hadiah' => 'required',
        'deskripsi' => 'required',
        'jumlah_poin' => 'required|numeric',
        'stok' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $hadiah = Hadiah::findOrFail($id);
    $data = $request->all();
    
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($hadiah->gambar && Storage::disk('public')->exists($hadiah->gambar)) {
            Storage::disk('public')->delete($hadiah->gambar);
        }
        
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('hadiah', $namaGambar, 'public');
        $data['gambar'] = $path;
    }

    $hadiah->update($data);
    return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil diperbarui');
}

public function destroy($id)
{
    $hadiah = Hadiah::findOrFail($id);
    
    // Hapus gambar jika ada
    if ($hadiah->gambar && Storage::disk('public')->exists($hadiah->gambar)) {
        Storage::disk('public')->delete($hadiah->gambar);
    }
    
    $hadiah->delete();
    return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil dihapus');
}
}