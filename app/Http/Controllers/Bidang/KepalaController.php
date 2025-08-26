<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KepalaController extends Controller
{
    public function dataSuratMasuk()
    {
        // $surats = SuratMasuk::latest()->get();
        $surats = SuratMasuk::where('status_disposisi', 'Belum')
            ->where('status_kabid', 'Belum Selesai')
            ->get();
        return view('kepala.dataSuratMasuk', compact('surats'));
    }
    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('kepala.detail_surat', compact('surat'));
    }
    public function arsip_surat()
    {
        $surats = SuratMasuk::where('status_disposisi', 'Didisposisikan')->get();
        return view('kepala.arsip', compact('surats'));
    }


    public function index(Request $request)
    {
        // $totalSurat = SuratMasuk::count();
        $totalArsipSurat = SuratMasuk::where('status_disposisi', 'Didisposisikan')->count();
        $belumDisposisi = SuratMasuk::where('status_disposisi', 'Belum')->count();
        $sudahDisposisi = SuratMasuk::where('status_disposisi', 'Didisposisikan')->count();
        $surats = SuratMasuk::where(function ($q) {
            // tampilkan semua surat yang belum selesai
            $q->whereNull('tanggal_selesai')
                ->orWhere('tanggal_selesai', '>=', now()->startOfDay());
        })
            ->latest()
            ->get();

        $steps = ['Kepala Badan', 'Sekretaris', 'Kepala', 'Selesai'];

        return view('kepala.dashboard', compact(
            'totalArsipSurat',
            'belumDisposisi',
            'sudahDisposisi',
            'surats',
            'steps'

        ));
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
