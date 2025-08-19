<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\DistribusiSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DisposisiController extends Controller
{
    public function index()
    {
        // Ambil semua data disposisi beserta relasi surat dan user
        $disposisis = Disposisi::with(['surat', 'dari'])->latest()->get();

        return view('admin.disposisi', compact('disposisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat_masuks,id',
            'kepada_bidang' => 'required|array',
            'kepada_bidang.*' => 'string',
            'isi_disposisi' => 'required|string',
            'tindakan' => 'nullable|array',
        ]);

        Disposisi::create([
            'surat_id' => $request->surat_id,
            'tanggal' => now(),
            'kepada_bidang' => implode(',', $request->kepada_bidang), // Kepala tentukan tujuan
            'isi_disposisi' => $request->isi_disposisi,
            'tindakan' => implode(', ', $request->tindakan ?? []),
            'dari_id' => Auth::id(),
            'status' => 'Menunggu Sekretaris', // <-- tambahan status
        ]);

        $surat = SuratMasuk::find($request->surat_id);
        $surat->status_disposisi = 'Didisposisikan';
        $surat->save();

        // 📢 Kirim WA ke Sekretaris
        $pesan = "Kepala Badan : 📩 *Disposisi Baru dari Kepala Badan*\n"
            . "Instansi: *{$surat->asal_surat}*\n"
            . "No. Surat: *{$surat->no_surat}*\n"
            . "Perihal: *{$surat->perihal}*\n"
            . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n\n"
            . "Silakan login untuk melihat detail disposisi:\n"
            . "https://simakbkad-production-5898.up.railway.app/";

        $this->kirimWaSekretaris($pesan);
        // dd($response);
        return redirect()->route('kepala.dataSuratMasuk')->with('success', 'Disposisi berhasil dikirim dan notifikasi WA terkirim!');
    }

    public function kirimWaSekretaris($pesan)
    {
        $response = Http::withHeaders([
            'Authorization' => '6FgWhQZsCZBPm8fZAUSW', // token dari Fonnte
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => '6281275232909', // nomor sekretaris
            'message' => $pesan,
        ]);

        return $response->json();
    }

    public function detail($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);
        $surat = $disposisi->surat;
        return view('admin.detail_disposisi', compact('disposisi', 'surat'));
    }


    // == ASSET ==
    public function disposisiAsset()
    {
        $user = Auth::user();

        $nama_bidang = 'KABID BMD';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = Disposisi::where('kepada_bidang', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('asset.disposisi.index', compact('disposisis'));
    }
    public function detailAsset($id)
    {
        // Ambil disposisi
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil surat terkait
        $surat = SuratMasuk::findOrFail($disposisi->surat_id);

        // Ambil distribusi surat berdasarkan surat_id
        $distribusi = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('asset.disposisi_detail', compact('disposisi', 'distribusi', 'surat'));
    }



    // == AKUNTANSI ==
    public function disposisiAkuntansi()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID AKUNTANSI';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = Disposisi::where('kepada_bidang', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('akuntansi.disposisi.index', compact('disposisis'));
    }
    public function detailAkuntansi($id)
    {
        // Ambil disposisi
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil surat terkait
        $surat = SuratMasuk::findOrFail($disposisi->surat_id);

        // Ambil distribusi surat berdasarkan surat_id
        $distribusi = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('akuntansi.disposisi_detail', compact('disposisi', 'distribusi', 'surat'));
    }



    // == ANGGARAN ==
    public function disposisiAnggaran()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID PENGANGGARAN';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = Disposisi::where('kepada_bidang', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('anggaran.disposisi.index', compact('disposisis'));
    }
    public function detailAnggaran($id)
    {
        // Ambil disposisi
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil surat terkait
        $surat = SuratMasuk::findOrFail($disposisi->surat_id);

        // Ambil distribusi surat berdasarkan surat_id
        $distribusi = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('anggaran.disposisi_detail', compact('disposisi', 'distribusi', 'surat'));
    }



    // == PEMBENDAHARAAN ==
    public function disposisiPembendaharaan()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID PEMBENDAHARAAN';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = Disposisi::where('kepada_bidang', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('pembendaharaan.disposisi.index', compact('disposisis'));
    }

    public function detailPembendaharaan($id)
    {
        // Ambil disposisi
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil surat terkait
        $surat = SuratMasuk::findOrFail($disposisi->surat_id);

        // Ambil distribusi surat berdasarkan surat_id
        $distribusi = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('pembendaharaan.disposisi_detail', compact('disposisi', 'distribusi', 'surat'));
    }
}
