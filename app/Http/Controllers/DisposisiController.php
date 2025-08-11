<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\DistribusiSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    public function index()
    {
        // Ambil semua data disposisi beserta relasi surat dan user
        $disposisis = Disposisi::with(['surat', 'dari'])->latest()->get();

        return view('admin.disposisi', compact('disposisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat_masuks,id',
            'kepada_bidang' => 'required|array',
            'kepada_bidang.*' => 'string',
            'isi_disposisi' => 'required|string',
        ]);

        Disposisi::create([
            'surat_id' => $request->surat_id,
            'tanggal' => now(),
            'kepada_bidang' => implode(',', $request->kepada_bidang),
            'isi_disposisi' => $request->isi_disposisi,
            'tindakan' => implode(', ', $request->tindakan), // tambahkan ini di DB juga
            'dari_id' => Auth::id(),
        ]);

        // Tambahkan setelah Disposisi::create(...);
        $surat = SuratMasuk::find($request->surat_id);
        $surat->status_disposisi = 'Didisposisikan';
        $surat->save();

        return redirect()->route('kepala.dataSuratMasuk')->with('success', 'Disposisi berhasil dikirim!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Disposisi $disposisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disposisi $disposisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disposisi $disposisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disposisi $disposisi)
    {
        //
    }
    public function detail($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);
        $surat = $disposisi->surat;
        return view('admin.detail_disposisi', compact('disposisi', 'surat'));
    }



    
    public function disposisiAsset()
    {
        $user = Auth::user();

        $nama_bidang = 'KABID BMD';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = DistribusiSurat::where('bidang_tujuan', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('asset.disposisi.index', compact('disposisis'));
    }
    public function detailAsset($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);
        return view('asset.disposisi_detail', compact('disposisi'));
    }




    public function disposisiAkuntansi()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID AKUNTANSI';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = DistribusiSurat::where('bidang_tujuan', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('akuntansi.disposisi.index', compact('disposisis'));
    }

    public function detailAkuntansi($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil distribusi surat untuk surat ini (ambil 1 data saja)
        $distribusi_surat = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('akuntansi.disposisi_detail', compact('disposisi', 'distribusi_surat'));
    }





    public function disposisiAnggaran()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID PENGANGGARAN';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = DistribusiSurat::where('bidang_tujuan', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('anggaran.disposisi.index', compact('disposisis'));
    }

    public function detailAnggaran($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil distribusi surat untuk surat ini (ambil 1 data saja)
        $distribusi_surat = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('anggaran.disposisi_detail', compact('disposisi', 'distribusi_surat'));
    }




    public function disposisiPembendaharaan()
    {
        $user = Auth::user();

        // Pastikan nama bidang sama persis seperti di checkbox disposisi
        $nama_bidang = 'KABID PEMBENDAHARAAN';

        // Ambil disposisi yang mengandung nama bidang tersebut
        $disposisis = DistribusiSurat::where('bidang_tujuan', 'LIKE', '%' . $nama_bidang . '%')
            ->latest()
            ->get();

        return view('pembendaharaan.disposisi.index', compact('disposisis'));
    }

    

    public function detailPembendaharaan($id)
    {
        $disposisi = Disposisi::with(['surat', 'dari'])->findOrFail($id);

        // Ambil distribusi surat untuk surat ini (ambil 1 data saja)
        $distribusi_surat = DistribusiSurat::where('surat_id', $disposisi->surat_id)->first();

        return view('pembendaharaan.disposisi_detail', compact('disposisi', 'distribusi_surat'));
    }
}
