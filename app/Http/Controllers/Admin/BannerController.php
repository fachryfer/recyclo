<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::paginate(10);
        return view('pages.admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('pages.admin.banner.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_banner' => 'required|string|max:255',
            'file_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000',
            'status' => 'required|in:aktif,tidak_aktif',
        ], [
            'dimensions' => 'The :attribute must have a minimum width and height of 200 pixels and a maximum width and height of 2000 pixels.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileBanner = $request->file('file_banner');
        $fileBanner->storeAs('public/banners', $fileBanner->hashName());
        $fileName = $fileBanner->hashName();

        Banner::create([
            'nama_banner' => $request->nama_banner,
            'file_banner' => $fileName,
            'status' => $request->status,
        ]);

        Alert::success('Hore!', 'Banner berhasil ditambahkan!')->autoclose(3000);
        return redirect()->route('admin.banner.index');
    }

    public function show(Banner $banner) {}

    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);

        return view('pages.admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_banner' => 'required|string|min:5|max:255',
            'file_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048|dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000',
            'status' => 'required|in:aktif,tidak_aktif',
        ], [
            'dimensions' => 'The :attribute must have minimum width and height of 200 pixels and maximum width and height of 2000 pixels.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner = Banner::findOrFail($id);

        $banner->nama_banner = $request->nama_banner;
        $banner->status = $request->status;

        if ($request->hasFile('file_banner')) {
            if ($banner->file_banner) {
                Storage::disk('public')->delete('banners/' . $banner->file_banner);
            }

            $fileBanner = $request->file('file_banner');
            $fileBanner->storeAs('public/banners', $fileBanner->hashName());
            $banner->file_banner = $fileBanner->hashName();
        }

        $banner->save();

        Alert::success('Hore!', 'Banner berhasil diperbarui!')->autoclose(3000);
        return redirect()->route('admin.banner.index');
    }


    public function destroy(Banner $banner)
    {
        if ($banner->file_banner) {
            Storage::disk('public')->delete($banner->file_banner);
        }
        $banner->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.');
    }
}
