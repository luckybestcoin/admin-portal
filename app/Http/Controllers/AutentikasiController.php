<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    //
    protected $redirectTo = '/';

    public function login(Request $req)
    {
        $req->validate([
            'id_pengguna' => 'required',
            'kata_sandi' => 'required'
        ]);

        $remember = $req->remember == 'on';
        if (Auth::attempt(['pengguna_uid' => $req->id_pengguna, 'password' => $req->kata_sandi], $remember)) {
            Auth::logoutOtherDevices($req->kata_sandi, 'pengguna_kata_sandi');
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->withErrors('<strong>Login Gagal!!!</strong><br> ID Pengguna atau Kata Sandi Salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
