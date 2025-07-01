<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TokenWhatsApp;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TokenWhatsAppController extends Controller
{
    public function index()
    {
        $token = TokenWhatsApp::first();
        return view('pages.admin.token_whatsapp.index', compact('token'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'token_whatsapp' => 'required|string|max:255'
        ]);

        $token = TokenWhatsApp::first();

        if ($token) {
            $token->update([
                'token_whatsapp' => $request->token_whatsapp,
            ]);
        } else {
            TokenWhatsApp::create([
                'token_whatsapp' => $request->token_whatsapp,
            ]);
        }

        Alert::success('Hore!', 'Token WhatsApp berhasil diperbarui!')->autoclose(3000);
        return redirect()->back();
    }
}
