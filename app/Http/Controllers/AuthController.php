<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Jika user sudah login, redirect ke halaman utama (home)
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        // Cek apakah request berasal dari AJAX atau bukan
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            // Proses login menggunakan Auth
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            // Jika login gagal
            return response()->json([
                'status' => false,
                'message' => 'Username atau password salah',
                'msgField' => ['username' => ['Username atau password salah']] // untuk handling AJAX validation error
            ]);
        }

        return redirect('login')->with('error', 'Login gagal, silakan coba lagi');
    }

    public function logout(Request $request)
    {
        // Logout user dan invalidasi session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
