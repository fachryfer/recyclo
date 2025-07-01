<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika nasabah sudah login, redirect ke welcome
        if (Session::has('nasabah_id')) {
            Alert::info('Info', 'Anda sudah login sebagai nasabah.');
            return redirect()->route('welcome');
        }

        // Jika admin/petugas sudah login, redirect ke dashboard sesuai role
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login sebagai admin/petugas
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }
        }

        // Coba login sebagai nasabah
        $nasabah = Nasabah::where('username', $request->username)->first();
        
        if ($nasabah && password_verify($request->password, $nasabah->password)) {
            // Simpan data nasabah di session
            Session::put('nasabah_id', $nasabah->id);
            Session::put('nasabah_nama', $nasabah->nama_lengkap);
            Session::put('nasabah_role', 'nasabah');
            Session::put('nasabah_saldo', $nasabah->saldo ? $nasabah->saldo->saldo : 0);
            Session::put('nasabah_poin', $nasabah->poinNasabah ? $nasabah->poinNasabah->jumlah_poin : 0);
            
            Alert::success('Berhasil!', 'Selamat datang kembali, ' . $nasabah->nama_lengkap);
            return redirect()->route('welcome');
        }

        Alert::error('Gagal!', 'Username atau password salah');
        return back();
    }

    public function logout()
    {
        // Hapus session nasabah jika ada
        if (Session::has('nasabah_id')) {
            Session::forget(['nasabah_id', 'nasabah_nama', 'nasabah_role', 'nasabah_saldo', 'nasabah_poin']);
        }
        
        // Logout admin/petugas jika ada
        Auth::logout();

        Alert::success('Selamat Tinggal!', 'Anda telah berhasil logout.');

        return redirect()->route('login');
    }
}
