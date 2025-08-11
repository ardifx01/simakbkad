<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\DistribusiSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

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

        return redirect()->route('sekretaris.dataSuratMasuk')
            ->with('success', 'Distribusi surat berhasil disimpan.');
    }
}
