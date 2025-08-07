<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'no_surat'       => 'required|string|max:255',
            'asal_surat'     => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'jenis_surat'    => 'required|string',
            'file_surat'     => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'tanggal_surat'  => 'required|date',
            'tanggal_masuk'  => 'required|date',
            'no_agenda'      => 'nullable|string|max:255',
            'sifat'          => 'required|string',
        ]);

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $uploadedFilePath = $request->file('file_surat')->getRealPath();

        $uploadResult = $cloudinary->uploadApi()->upload($uploadedFilePath, [
            'folder' => 'surat_masuk',
            'resource_type' => 'auto'
        ]);

        $fileUrl = $uploadResult['secure_url'];

        $surat = SuratMasuk::create([
            'no_surat'         => $request->no_surat,
            'asal_surat'       => $request->asal_surat,
            'perihal'          => $request->perihal,
            'jenis_surat'      => $request->jenis_surat,
            'file_surat'       => $fileUrl,
            'tanggal_surat'    => $request->tanggal_surat,
            'tanggal_masuk'    => $request->tanggal_masuk,
            'no_agenda'        => $request->no_agenda,
            'sifat'            => $request->sifat,
            'created_by'       => Auth::id(),
            'status_disposisi' => 'Belum',
        ]);

        $pesan = "📩 *Surat Masuk Baru*\n"
            . "Instansi: *{$surat->asal_surat}*\n"
            . "No. Surat: *{$surat->no_surat}*\n"
            . "Perihal: *{$surat->perihal}*\n"
            . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
            . "Silakan login untuk melakukan disposisi:\n"
            . "https://simakbkad-production-5898.up.railway.app/";


        $this->kirimWaKaban($pesan);

        return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil ditambahkan.');
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
