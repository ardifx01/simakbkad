<?php

namespace App\Http\Controllers;

use App\Models\DistribusiSurat;
use Illuminate\Http\Request;

class SekretarisDistribusiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat_masuk,id',
            'catatan' => 'required|string',
            'kepada_bidang' => 'required|array|min:1',
            'kepada_bidang.*' => 'string'
        ]);

        // Simpan satu distribusi untuk tiap bidang yang dipilih
        foreach ($request->kepada_bidang as $bidang) {
            DistribusiSurat::create([
                'surat_id' => $request->surat_id,
                'catatan' => $request->catatan,
                'kepada_bidang' => $bidang,
            ]);
        }

        return redirect()->route('sekretaris.dataSuratMasuk')->with('success', 'Surat berhasil didistribusikan.');
    }
}
