<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class SampahController extends Controller
{
    public function index()
    {
        $sampahs = Sampah::paginate(10);
        return view('pages.admin.sampah.index', compact('sampahs'));
    }

    public function create()
    {
        return view('pages.admin.sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sampah = new Sampah($request->only('nama_sampah', 'harga_per_kg'));

        if ($request->hasFile('gambar')) {
            $fileName = Str::random(40) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->storeAs('public/sampah', $fileName);
            $sampah->gambar = $fileName;
        }

        $sampah->save();
        Alert::success('Hore!', 'Data sampah berhasil ditambahkan!')->autoclose(3000);
        return redirect()->route('admin.sampah.index');
    }


    public function show(Sampah $sampah)
    {
    }

    public function edit(string $id)
    {
        $sampah = Sampah::findOrFail($id);

        return view('pages.admin.sampah.edit', compact('sampah'));
    }


    public function update(Request $request, string $id)
    {
        $sampah = Sampah::findOrFail($id);

        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sampah->fill($request->only('nama_sampah', 'harga_per_kg'));

        if ($request->hasFile('gambar')) {
            if ($sampah->gambar) {
                Storage::delete('public/sampah/' . $sampah->gambar);
            }
            $fileName = Str::random(40) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->storeAs('public/sampah', $fileName);
            $sampah->gambar = $fileName;
        }

        $sampah->save();
        Alert::success('Berhasil!', 'Data sampah berhasil diperbarui.')->autoclose(3000);
        return redirect()->route('admin.sampah.index');
    }



    public function destroy(Request $request, $id)
    {
        try {
            $sampah = \App\Models\Sampah::findOrFail($id);
        if ($sampah->gambar) {
                Storage::delete('public/sampah/' . $sampah->gambar);
        }
            $deleted = $sampah->delete();
            if ($deleted) {
                return redirect()->route('admin.sampah.index')->with('success', 'Sampah berhasil dihapus.');
            } else {
                return redirect()->route('admin.sampah.index')->with('error', 'Gagal menghapus sampah (query gagal).');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.sampah.index')->with('error', 'Gagal menghapus sampah: ' . $e->getMessage());
        }
    }
}
