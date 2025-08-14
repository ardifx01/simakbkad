<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\DistribusiSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SekretarisController extends Controller
{
    public function dataSuratMasuk()
    {
        // Ambil surat yang sudah didisposisikan ke Sekretaris
        $surats = SuratMasuk::whereHas('disposisi', function ($query) {
            $query->where('kepada_bidang', 'LIKE', '%Sekretaris%');
        })
            ->latest()
            ->get();

        return view('sekretaris.dataSuratMasuk', compact('surats'));
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $bidangs = Bidang::all(); // ambil semua bidang

        // Ambil disposisi dari Kaban yang mengarah ke Sekretaris
        $disposisiKaban = $surat->disposisi()
            ->where('kepada_bidang', 'LIKE', '%Sekretaris%')
            ->first();

        return view('sekretaris.detail_surat', compact('surat', 'disposisiKaban', 'bidangs'));
    }


    public function detailDisposisi($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $disposisi = $surat->disposisi; // Relasi dari model SuratMasuk
        return view('sekretaris.detailDisposisi', compact('surat', 'disposisi'));
    }

    // public function storeDistribusi(Request $request)
    // {
    //     $request->validate([
    //         'surat_id' => 'required|exists:surat_masuks,id',
    //         'kepada_bidang' => 'required|array',
    //         'kepada_bidang.*' => 'string|max:255',
    //         'catatan' => 'nullable|string',
    //     ]);

    //     DistribusiSurat::create([
    //         'surat_id' => $request->surat_id,
    //         'bidang_tujuan' => implode(', ', $request->kepada_bidang),
    //         'catatan_sekretaris' => $request->catatan,
    //     ]);

    //     return redirect()->route('sekretaris.dataSuratMasuk')
    //         ->with('success', 'Distribusi surat berhasil disimpan.');
    // }


    public function storeDistribusi(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat_masuks,id',
            'kepada_bidang' => 'required|array',
            'kepada_bidang.*' => 'string|max:255',
            'catatan' => 'nullable|string',
        ]);

        DistribusiSurat::create([
            'surat_id' => $request->surat_id,
            'bidang_tujuan' => implode(', ', $request->kepada_bidang),
            'catatan_sekretaris' => $request->catatan,
        ]);

        // Ambil data surat untuk isi pesan
        $surat = SuratMasuk::find($request->surat_id);

        $pesan = "📩 *Surat Masuk Didistribusikan*\n"
            . "Dari Sekretaris ke Kabid\n\n"
            . "No. Surat: *{$surat->no_surat}*\n"
            . "Perihal: *{$surat->perihal}*\n"
            . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
            . "Catatan Sekretaris: *" . ($request->catatan ?? '-') . "*\n\n"
            . "Silakan login untuk melihat detail:\n"
            . "https://simakbkad-production-5898.up.railway.app/";

        // Kirim WA ke Kabid
        $this->kirimWaKabid($pesan);
        // dd($respones);
        return redirect()->route('sekretaris.dataSuratMasuk')
            ->with('success', 'Distribusi surat berhasil disimpan dan notifikasi WA terkirim.');
    }

    public function kirimWaKabid($pesan)
    {
        $response = Http::withHeaders([
            'Authorization' => '6FgWhQZsCZBPm8fZAUSW', // token Fonnte
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => '6281275232909', // nomor Kabid
            'message' => $pesan,
        ]);

        return $response->json();
    }
}
