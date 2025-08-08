<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $roles = Role::all();
        return view('auth.login', compact('roles'));
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        // ✅ Cek apakah user ditemukan dan aktif
        if (!$user || !$user->is_active) {
            return back()->with('error', 'Akun tidak aktif atau tidak ditemukan.');
        }

        // Cek kredensial
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $role = Auth::user()->role->nama_role;

            switch ($role) {
                case 'Admin':
                    return redirect()->route('admin.dashboard');
                case 'Kepala Badan':
                    return redirect()->route('kepala.dashboard');
                case 'Sekretaris':
                    return redirect()->route('sekretaris.dashboard');
                case 'Bidang Asset':
                    return redirect()->route('asset.dashboard');
                case 'Bidang Akuntansi':
                    return redirect()->route('akuntansi.dashboard');
                case 'Bidang Anggaran':
                    return redirect()->route('anggaran.dashboard');
                case 'Bidang Pembendaharaan':
                    return redirect()->route('pembendaharaan.dashboard');
                default:
                    return redirect()->route('login')->with('error', 'Role tidak dikenal.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
