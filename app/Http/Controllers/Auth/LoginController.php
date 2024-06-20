<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();

            $user = Auth::user();
            if ($user->status === 'Non aktif') {
                Auth::logout();
                Alert::toast('Akun Anda dinonaktifkan, silahkan hubungi Admin', 'error');
                return redirect()->route('login');
            }

            if ($user->role === 'Petugas') {
                return redirect()->route('transaction');
            }

            return redirect()->intended('beranda');
        } else {
            Alert::toast('Username atau password yang Anda masukkan salah', 'error');
            return back();
        }
    }

    public function logout(Request $request)
    {
        $title = 'Warning';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title, $text);

        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
