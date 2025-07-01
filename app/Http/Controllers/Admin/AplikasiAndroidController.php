<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiAndroid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AplikasiAndroidController extends Controller
{
    public function index()
    {
        $aplikasi = AplikasiAndroid::first();

        return view('pages.admin.update_apk.index', compact('aplikasi'));
    }

    public function create()
    {
        return view('pages.admin.update_apk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'apk_file' => 'required|file|max:51200',
            'versi_aplikasi' => 'required|string|max:50',
            'keterangan' => 'nullable|string'
        ]);

        $file = $request->file('apk_file');
        $fileSize = $file->getSize();

        $namaAplikasi = 'BankSampahRendole';

        $formattedFileName = Str::slug($namaAplikasi . '_v' . $request->versi_aplikasi . '_' . now()->format('YmdHis')) . '.apk';

        $filePath = $file->storeAs('public/aplikasi', $formattedFileName);

        $urlApk = Storage::url($filePath);

        AplikasiAndroid::create([
            'versi_aplikasi' => $request->versi_aplikasi,
            'nama_file' => $formattedFileName,
            'ukuran_file' => $fileSize,
            'url_apk' => $urlApk,
            'keterangan' => $request->keterangan
        ]);

        Alert::success('Hore!', 'APK berhasil diunggah dan disimpan!')->autoclose(3000);
        return redirect()->route('admin.aplikasi.index');
    }


    public function edit($id)
    {
        $aplikasi = AplikasiAndroid::findOrFail($id);
        return view('pages.admin.update_apk.edit', compact('aplikasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'apk_file' => 'nullable|file|max:51200',
            'versi_aplikasi' => 'required|string|max:50',
            'keterangan' => 'nullable|string'
        ]);

        $aplikasi = AplikasiAndroid::findOrFail($id);

        if ($request->hasFile('apk_file')) {
            $file = $request->file('apk_file');
            $fileSize = $file->getSize();

            $formattedFileName = 'BankSampahRendole_v' . $request->versi_aplikasi . '_' . now()->format('YmdHis') . '.apk';

            Storage::delete('public/aplikasi/' . $aplikasi->nama_file);

            $filePath = $file->storeAs('public/aplikasi', $formattedFileName);
            $urlApk = Storage::url($filePath);

            $aplikasi->update([
                'versi_aplikasi' => $request->versi_aplikasi,
                'nama_file' => $formattedFileName,
                'ukuran_file' => $fileSize,
                'url_apk' => $urlApk,
                'keterangan' => $request->keterangan
            ]);
        } else {
            $aplikasi->update([
                'versi_aplikasi' => $request->versi_aplikasi,
                'keterangan' => $request->keterangan
            ]);
        }

        Alert::success('Sukses!', 'APK berhasil diperbarui!')->autoclose(3000);
        return redirect()->route('admin.aplikasi.index');
    }

}
