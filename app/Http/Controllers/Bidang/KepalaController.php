<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KepalaController extends Controller
{
    public function dataSuratMasuk()
    {
        $surats = SuratMasuk::latest()->get();
        return view('kepala.dataSuratMasuk', compact('surats'));
    }
    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('kepala.detail_surat', compact('surat'));
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'surat_id' => 'required|exists:surat_masuks,id',
    //         'kepada_bidang' => 'required|array|min:1',
    //         'isi_disposisi' => 'required|string',
    //     ]);

    //     foreach ($request->kepada_bidang as $bidang) {
    //         \App\Models\Disposisi::create([
    //             'surat_id' => $request->surat_id,
    //             'dari_id' => Auth::id(),
    //             'kepada_bidang' => $bidang,
    //             'isi_disposisi' => $request->isi_disposisi,
    //             'tanggal' => now(),
    //         ]);
    //     }

    //     // Update status disposisi surat
    //     \App\Models\SuratMasuk::where('id', $request->surat_id)
    //         ->update(['status_disposisi' => 'Didisposisikan']);

    //     return redirect()->route('kepala.dataSuratMasuk')->with('success', 'Disposisi berhasil dikirim!');
    // }
}
