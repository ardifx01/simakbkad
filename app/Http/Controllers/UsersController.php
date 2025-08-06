<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.tambahPengguna', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ], [
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

        return redirect()->route('admin.tambahPengguna')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Status pengguna berhasil diperbarui.');
    }
}
