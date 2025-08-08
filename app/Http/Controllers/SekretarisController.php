<?php

namespace App\Http\Controllers;

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

        // Ambil disposisi dari Kaban yang mengarah ke Sekretaris
        $disposisiKaban = $surat->disposisi()
            ->where('kepada_bidang', 'LIKE', '%Sekretaris%')
            // ->where('dari_bidang', 'LIKE', '%Kaban%') // pastikan ada kolom 'dari_bidang' di tabel disposisi
            ->first();

        return view('sekretaris.detail_surat', compact('surat', 'disposisiKaban'));
    }


    public function detailDisposisi($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $disposisi = $surat->disposisi; // Relasi dari model SuratMasuk
        return view('sekretaris.detailDisposisi', compact('surat', 'disposisi'));
    }

    public function Store(){

    }
}
