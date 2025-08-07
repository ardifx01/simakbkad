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
        // ✅ 1. Validasi Input
        $request->validate([
            'jenis_surat'   => 'required|string|max:100',
            'no_surat'      => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'asal_surat'    => 'required|string|max:255',
            'perihal'       => 'required|string|max:255',
            'file_surat'    => 'required|file|mimes:pdf|max:2048',
            'no_agenda'     => 'nullable|string|max:50',
            'sifat'         => 'nullable|string|max:50',
        ]);

        // ✅ 2. Upload ke Cloudinary
        try {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('file_surat')->getRealPath(),
                ['folder' => 'surat_masuk', 'resource_type' => 'auto']
            );

            $fileUrl = $uploadResult['secure_url'];
        } catch (\Exception $e) {
            Log::error('Upload Cloudinary gagal: ' . $e->getMessage());
            return back()->with('error', 'Gagal upload ke Cloudinary.');
        }

        // ✅ 3. Simpan ke Database
        try {
            SuratMasuk::create([
                'jenis_surat'      => $request->jenis_surat,
                'no_surat'         => $request->no_surat,
                'tanggal_surat'    => $request->tanggal_surat,
                'tanggal_masuk'    => $request->tanggal_masuk,
                'asal_surat'       => $request->asal_surat,
                'perihal'          => $request->perihal,
                'file_surat'       => $fileUrl,
                'no_agenda'        => $request->no_agenda,
                'sifat'            => $request->sifat,
                'created_by'       => Auth::id(),
                'status_disposisi' => 'Belum',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal simpan surat masuk: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan data ke database.');
        }

        // ✅ 4. Kirim Notifikasi WhatsApp
        try {
            $pesan = "📩 Surat baru masuk dari *{$request->asal_surat}* dengan perihal: *{$request->perihal}*.\nSilakan cek sistem untuk disposisi:\nhttps://simakbkad-production-5898.up.railway.app/";
            $this->kirimWaKaban($pesan);
        } catch (\Exception $e) {
            Log::warning('Gagal kirim WA: ' . $e->getMessage());
        }

        // ✅ 5. Redirect Sukses
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
