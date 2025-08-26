<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\ArsipSurat;
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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'no_surat'       => 'required|string|max:255',
    //         'asal_surat'     => 'required|string|max:255',
    //         'perihal'        => 'required|string|max:255',
    //         'jenis_surat'    => 'required|string',
    //         'file_surat'     => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
    //         'tanggal_surat'  => 'required|date',
    //         'tanggal_masuk'  => 'required|date',
    //         'no_agenda'      => 'nullable|string|max:255',
    //         'sifat'          => 'required|string',
    //     ]);

    //     $cloudinary = new \Cloudinary\Cloudinary([
    //         'cloud' => [
    //             'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    //             'api_key'    => env('CLOUDINARY_API_KEY'),
    //             'api_secret' => env('CLOUDINARY_API_SECRET'),
    //         ],
    //     ]);

    //     $uploadedFilePath = $request->file('file_surat')->getRealPath();

    //     $uploadResult = $cloudinary->uploadApi()->upload($uploadedFilePath, [
    //         'folder' => 'surat_masuk',
    //         'resource_type' => 'auto'
    //     ]);

    //     $fileUrl = $uploadResult['secure_url'];

    //     $surat = SuratMasuk::create([
    //         'no_surat'         => $request->no_surat,
    //         'asal_surat'       => $request->asal_surat,
    //         'perihal'          => $request->perihal,
    //         'jenis_surat'      => $request->jenis_surat,
    //         'file_surat'       => $fileUrl,
    //         'tanggal_surat'    => $request->tanggal_surat,
    //         'tanggal_masuk'    => $request->tanggal_masuk,
    //         'no_agenda'        => $request->no_agenda,
    //         'sifat'            => $request->sifat,
    //         'created_by'       => Auth::id(),
    //         'status_disposisi' => 'Belum',
    //     ]);

    //     $pesan = "📩 *Surat Masuk Baru*\n"
    //         . "Instansi: *{$surat->asal_surat}*\n"
    //         . "No. Surat: *{$surat->no_surat}*\n"
    //         . "Perihal: *{$surat->perihal}*\n"
    //         . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
    //         . "Silakan login untuk melakukan disposisi:\n"
    //         . "https://simakbkad-production-5898.up.railway.app/";


    //     $this->kirimWaKaban($pesan);

    //     return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil ditambahkan.');
    // }

    // public function arsip_surat()
    // {
    //     $surats = SuratMasuk::latest()->get();
    //     return view('admin.arsip', compact('surats'));
    // }

    public function arsip_surat(Request $request)
    {
        $filter = $request->get('filter');
        $tanggal = $request->get('tanggal');
        $query = SuratMasuk::query();

        if ($filter == 'harian') {
            $query->whereDate('tanggal_masuk', now()->toDateString());
        } elseif ($filter == 'mingguan') {
            $query->whereBetween('tanggal_masuk', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($filter == 'bulanan') {
            $query->whereMonth('tanggal_masuk', now()->month)
                ->whereYear('tanggal_masuk', now()->year);
        } elseif ($filter == 'tanggal' && $tanggal) {
            $query->whereDate('tanggal_masuk', $tanggal);
        }

        $surats = $query->orderBy('tanggal_masuk', 'desc')->get();

        return view('admin.arsip', compact('surats', 'filter', 'tanggal'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // 'no_agenda'      => 'required|string|max:255',
    //         'no_surat'       => 'required|string|max:255',
    //         'asal_surat'     => 'required|string|max:255',
    //         'perihal'        => 'required|string|max:255',
    //         'jenis_surat'    => 'required|string',
    //         'file_surat'     => 'required|file|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/*|max:5120',
    //         'tanggal_surat'  => 'required|date',
    //         'tanggal_masuk'  => 'required|date',
    //         'sifat'          => 'required|string',
    //     ]);

    //     // Simpan file ke storage
    //     $file = $request->file('file_surat');
    //     $fileName = time() . '_' . $file->getClientOriginalName();
    //     $path = $file->storeAs('surat_masuk', $fileName, 'public');

    //     $tahun = date('Y', strtotime($request->tanggal_masuk));

    //     // cari surat terakhir sebelum tanggal ini
    //     $lastBefore = SuratMasuk::whereYear('tanggal_masuk', $tahun)
    //         ->where('tanggal_masuk', '<=', $request->tanggal_masuk)
    //         ->orderBy('tanggal_masuk', 'desc')
    //         ->orderBy('no_agenda', 'desc')
    //         ->first();

    //     if ($lastBefore) {
    //         // $posisi = (int) $lastBefore->no_agenda;
    //         $parts = explode('/', $lastBefore->no_agenda);
    //         $posisi = (int) $parts[0];
    //     } else {
    //         $posisi = 0; // belum ada surat tahun ini
    //     }
    //     $newAgenda = $posisi + 1;
    //     $frmtAgenda = $newAgenda . "/BKAD/" . $tahun;

    //     $suratSetelah = SuratMasuk::whereYear('tanggal_masuk', $tahun)
    //         ->where('tanggal_masuk', '>', $request->tanggal_masuk)
    //         ->orderBy('tanggal_masuk')
    //         ->get();

    //     foreach ($suratSetelah as $s) {
    //         $parts = explode('/', $s->no_agenda);
    //         $num = (int) $parts[0];
    //         if ($num > $posisi) {
    //             $num++;
    //             $s->no_agenda = $num . "/BKAD/" . $tahun;
    //             $s->save();
    //         }
    //     }

    //     // simpan surat baru dengan nomor agenda yang sesuai
    //     $surat = SuratMasuk::create([
    //         'no_surat'         => $request->no_surat,
    //         'asal_surat'       => $request->asal_surat,
    //         'perihal'          => $request->perihal,
    //         'jenis_surat'      => $request->jenis_surat,
    //         'file_surat'       => $path,
    //         'tanggal_surat'    => $request->tanggal_surat,
    //         'tanggal_masuk'    => $request->tanggal_masuk,
    //         'no_agenda'        => $frmtAgenda,
    //         'sifat'            => $request->sifat,
    //         'created_by'       => Auth::id(),
    //         'status_disposisi' => 'Belum',
    //     ]);

    //     // Kirim notifikasi WA ke Kepala Badan
    //     $pesan = "Admin : 📩 *Surat Masuk Baru*\n"
    //         . "Instansi: *{$surat->asal_surat}*\n"
    //         . "No. Surat: *{$surat->no_surat}*\n"
    //         . "Perihal: *{$surat->perihal}*\n"
    //         . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
    //         . "No. Agenda: *{$surat->no_agenda}*\n"
    //         . "Silakan login untuk melakukan disposisi:\n"
    //         . "https://simakbkad-production-5898.up.railway.app/";

    //     $this->kirimWaKaban($pesan);

    //     return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat'       => 'required|string|max:255',
            'asal_surat'     => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'jenis_surat'    => 'required|string',
            'file_surat'     => 'required|file|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/*|max:5120',
            'tanggal_surat'  => 'required|date',
            'tanggal_masuk'  => 'required|date',
            'sifat'          => 'required|string',
        ]);

        // Simpan file ke storage
        $file = $request->file('file_surat');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('surat_masuk', $fileName, 'public');

        // Tentukan kategori agenda
        $jenis = $request->jenis_surat;
        if ($jenis === 'LS (Langsung)') {
            $kategori = 'LS';
        } elseif ($jenis === 'GU (Ganti Uang) / TU (Tambahan Uang)') {
            $kategori = 'GU';
        } else {
            $kategori = 'LAINNYA';
        }

        $tahun = date('Y', strtotime($request->tanggal_masuk));

        // Cari agenda terakhir di tahun ini khusus kategori tsb
        $lastAgenda = SuratMasuk::whereYear('tanggal_masuk', $tahun)
            ->where('kategori_agenda', $kategori)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastAgenda) {
            $parts = explode('/', $lastAgenda->no_agenda);
            $posisi = (int) $parts[0];
        } else {
            $posisi = 0;
        }

        $newAgenda = $posisi + 1;
        $frmtAgenda = $newAgenda . "/BKAD/" . $tahun;

        // Simpan surat baru
        $surat = SuratMasuk::create([
            'no_surat'         => $request->no_surat,
            'asal_surat'       => $request->asal_surat,
            'perihal'          => $request->perihal,
            'jenis_surat'      => $jenis,
            'file_surat'       => $path,
            'tanggal_surat'    => $request->tanggal_surat,
            'tanggal_masuk'    => $request->tanggal_masuk,
            'no_agenda'        => $frmtAgenda,
            'kategori_agenda'  => $kategori,
            'sifat'            => $request->sifat,
            'created_by'       => Auth::id(),
            'status_disposisi' => 'Belum',
        ]);

        // Kirim notifikasi WA ke Kepala Badan
        $pesan = "Admin : 📩 *Surat Masuk Baru*\n"
            . "Instansi: *{$surat->asal_surat}*\n"
            . "No. Surat: *{$surat->no_surat}*\n"
            . "Perihal: *{$surat->perihal}*\n"
            . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
            . "No. Agenda: *{$surat->no_agenda}*\n"
            . "Silakan login untuk melakukan disposisi:\n"
            . "https://simakbkad-production-5898.up.railway.app/";

        $this->kirimWaKaban($pesan);

        return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil ditambahkan.');
    }



    public function kirimWaKaban($pesan)
    {
        $response = Http::withHeaders([
            'Authorization' => '6FgWhQZsCZBPm8fZAUSW',
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => '6281275232909', // no kaban
            'message' => $pesan,
        ]);

        return $response->json();
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
    public function destroy(string $id)
    {
        $cari = SuratMasuk::findOrFail($id);
        $cari->delete();
        return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil dihapus.');
    }

    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('admin.editSurat', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_surat'       => 'required|string|max:255',
            'asal_surat'     => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'tanggal_surat'  => 'required|date',
            'tanggal_masuk'  => 'required|date',
            'sifat'          => 'required|string',
            'jenis_surat'    => 'required|string',
            'file_surat'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat = SuratMasuk::findOrFail($id);

        $surat->no_surat      = $request->no_surat;
        $surat->asal_surat    = $request->asal_surat;
        $surat->perihal       = $request->perihal;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->tanggal_masuk = $request->tanggal_masuk;
        $surat->sifat         = $request->sifat;
        $surat->jenis_surat   = $request->jenis_surat;

        if ($request->hasFile('file_surat')) {
            // hapus file lama jika ada
            if ($surat->file_surat && file_exists(public_path('uploads/surat/' . $surat->file_surat))) {
                unlink(public_path('uploads/surat/' . $surat->file_surat));
            }

            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat'), $filename);

            $surat->file_surat = $filename;
        }

        $surat->save();

        return redirect()->route('admin.dataSuratMasuk')->with('success', 'Surat berhasil diperbarui!');
    }
}
