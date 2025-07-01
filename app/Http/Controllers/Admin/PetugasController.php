<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::paginate(10);
        return view('pages.admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('pages.admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas',
            'username' => 'required|string|unique:petugas',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,petugas'
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Alert::success('Berhasil!', 'Petugas berhasil ditambahkan!')->autoclose(3000);
        return redirect()->route('admin.petugas.index');
    }

    // public function show(Petugas $petugas)
    // {
    //     return view('admin.petugas.show', compact('petugas'));
    // }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);

        return view('pages.admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email,' . $id,
            'username' => 'required|string|unique:petugas,username,' . $id,
            'role' => 'required|in:admin,petugas',
            // password tidak wajib diisi saat edit
        ]);

        $data = $request->only(['nama', 'email', 'username', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        Alert::success('Berhasil!', 'Data petugas berhasil diupdate!')->autoclose(3000);
        return redirect()->route('admin.petugas.index');
    }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();
        Alert::success('Berhasil!', 'Petugas berhasil dihapus!')->autoclose(3000);
        return redirect()->route('admin.petugas.index');
    }
}
