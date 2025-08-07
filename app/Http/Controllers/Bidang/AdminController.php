<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function surat_masuk()
    {
        return view('admin.inputSuratMasuk');
    }
    public function data_surat()
    {
        return view('admin.dataSuratMasuk');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_surat'   => 'required',
            'no_surat'      => 'required',
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'asal_surat'    => 'required',
            'perihal'       => 'required',
            'file_surat'    => 'required|file|mimes:pdf|max:2048',
        ]);

        // Upload file ke Cloudinary
        try {
            $uploadResult = Cloudinary::upload(
                $request->file('file_surat')->getRealPath(),
                ['folder' => 'surat_masuk']
            );

            $fileUrl = $uploadResult->getSecurePath(); // URL file yang disimpan
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload ke Cloudinary: ' . $e->getMessage());
        }

        // Simpan data ke database
        try {
            \App\Models\SuratMasuk::create([
                'jenis_surat'   => $request->jenis_surat,
                'no_surat'      => $request->no_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'tanggal_masuk' => $request->tanggal_masuk,
                'asal_surat'    => $request->asal_surat,
                'perihal'       => $request->perihal,
                'file_surat'    => $fileUrl,
                'no_agenda'     => $request->no_agenda,
                'sifat'         => $request->sifat,
                'created_by'    => Auth::id(),
                'status_disposisi' => 'Belum',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal simpan ke database: ' . $e->getMessage());
        }

        // Kirim notifikasi WA ke Kepala Badan
        $pesan = "📩 Surat baru masuk dari *{$request->asal_surat}* dengan perihal: *{$request->perihal}*.\nSilakan cek sistem untuk disposisi:\nhttps://simakbkad-production-5898.up.railway.app/";
        $this->kirimWaKaban($pesan);

        return redirect()->route('admin.input_surat')->with('success', 'Surat berhasil ditambahkan!');
    }




    public function dataSuratMasuk()
    {
        $surats = SuratMasuk::latest()->get();
        return view('admin.dataSuratMasuk', compact('surats'));
    }
    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('admin.detail_surat', compact('surat'));
    }
    public function showUser()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function kirimWaKaban($pesan)
    {
        $response = Http::withHeaders([
            'Authorization' => '6FgWhQZsCZBPm8fZAUSW',
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => '6281275232909',
            'message' => $pesan,
        ]);

        return $response->json();
    }
}
