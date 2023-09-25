<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {

        return view('welcome');
    }

    public function register()
    {

        return view('auth.register');
    }

    public function store_register(Request $req)
    {
        $data = User::create($req->all());

        // $biodata = $data->biodata_diri()->create($req->all());

        return redirect()->route('auth.login')->withSuccess('Berhasil register, silahkan login menggunakan akun yang anda daftarkan!');
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success','Anda berhasil logout');
    }
}
