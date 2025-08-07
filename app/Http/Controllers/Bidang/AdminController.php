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
        ], [
            'jenis_surat.required' => 'Jenis surat wajib di isi!',
            'no_surat.required' => 'Nomor surat wajib di isi!',
            'tanggal_surat.required' => 'Tanggal surat wajib di isi!',
            'tanggal_masuk.required' => 'Tanggal masuk wajib di isi!',
            'asal_surat.required' => 'Asal surat wajib di isi!',
            'perihal.required' => 'Perihal surat wajib di isi!',
            'file_surat.required' => 'File surat wajib di isi!',
            'file_surat.file' => 'File surat tidak valid!',
            'file_surat.mimes' => 'File surat harus format PDF!',
            'file_surat.max' => 'Ukuran file maksimal 2MB!',
        ]);

        // Proses Upload ke Cloudinary
        if ($request->hasFile('file_surat')) {
            try {
                $uploadedFile = Cloudinary::upload($request->file('file_surat')->getRealPath(), [
                    'folder' => 'surat_masuk'
                ]);

                $fileUrl = $uploadedFile->getSecurePath();
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal upload ke Cloudinary: ' . $e->getMessage());
            }
        } else {
            return back()->with('error', 'File tidak ditemukan.');
        }

        // Simpan ke database
        SuratMasuk::create([
            'jenis_surat'   => $request->jenis_surat,
            'no_surat'      => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'asal_surat'    => $request->asal_surat,
            'perihal'       => $request->perihal,
            'file_surat'    => $fileUrl, // link Cloudinary
            'no_agenda'     => $request->no_agenda,
            'sifat'         => $request->sifat,
            'created_by'    => Auth::id(),
            'status_disposisi' => 'Belum',
        ]);

        // Kirim Notifikasi WhatsApp
        $pesan = "📩 *Surat Baru Diterima*\n"
            . "Dari: *{$request->asal_surat}*\n"
            . "Perihal: *{$request->perihal}*\n"
            . "Silakan login untuk disposisi:\n"
            . "https://simakbkad-production-5898.up.railway.app/";

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
            'target' => '6282246605465', // Ganti dengan nomor Kepala Badan
            'message' => $pesan,
        ]);

        return $response->json();
    }
}
