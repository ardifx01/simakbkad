<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }
        public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ],[
            'nama.required' => 'Nama wajib di isi!',
            'nama.string' => 'Nama tidak bisa mengandung angka!',
            'nama.max' => 'Jumlah karakter maksimal 30 digit!',
            'email.required' => 'Email wajib di isi!',
            'email.email' => 'Format email tidak valid!',
            'role_id.required' => 'Silahkan pilih bidangnya!',
            'password.required' => 'Password wajib disi!',
            'password.min' => 'Password minimal 6 digit!'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
}
