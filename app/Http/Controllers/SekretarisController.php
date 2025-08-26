<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Disposisi;
use App\Models\DistribusiSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SekretarisController extends Controller
{
    public function index(Request $request)
    {
        // $totalSurat = SuratMasuk::count();
        $totalArsipSurat = SuratMasuk::where('status_sekretaris', 'Didistribusikan')->count();
        $belumDistribusi = SuratMasuk::where('status_sekretaris', 'Belum didistribusikan')
            ->where('status_disposisi', 'didisposisikan')
            ->count();

        $surats = SuratMasuk::where(function ($q) {
            // tampilkan semua surat yang belum selesai
            $q->whereNull('tanggal_selesai')
            ->where('status_disposisi', 'didisposisikan')
                ->orWhere('tanggal_selesai', '>=', now()->startOfDay());
        })
            ->latest()
            ->get();

        $steps = ['Kepala Badan', 'Sekretaris', 'Kepala', 'Selesai'];

        return view('sekretaris.dashboard', compact(
            'totalArsipSurat',
            'belumDistribusi',
            'surats',
            'steps'

        ));
    }
    public function dataSuratMasuk()
    {
        // Ambil surat yang sudah didisposisikan ke Sekretaris
        $surats = SuratMasuk::whereHas('disposisi', function ($query) {
            $query->where('kepada_bidang', 'LIKE', '%Sekretaris%')
                ->where('status_sekretaris', 'Belum Didistribusikan');
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

    public function arsip_surat()
    {
        $surats = SuratMasuk::where('status_sekretaris', 'Didistribusikan')->get();
        return view('sekretaris.arsip', compact('surats'));
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

    //     // Ambil data surat untuk isi pesan
    //     $surat = SuratMasuk::find($request->surat_id);

    //     $pesan = "📩 *Surat Masuk Didistribusikan*\n"
    //         . "Dari Sekretaris ke Kabid\n\n"
    //         . "No. Surat: *{$surat->no_surat}*\n"
    //         . "Perihal: *{$surat->perihal}*\n"
    //         . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
    //         . "Catatan Sekretaris: *" . ($request->catatan ?? '-') . "*\n\n"
    //         . "Silakan login untuk melihat detail:\n"
    //         . "https://simakbkad-production-5898.up.railway.app/";

    //     // Kirim WA ke Kabid
    //     $this->kirimWaKabid($pesan);
    //     // dd($respones);
    //     return redirect()->route('sekretaris.dataSuratMasuk')
    //         ->with('success', 'Distribusi surat berhasil disimpan dan notifikasi WA terkirim.');
    // }
    public function storeDistribusi(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat_masuks,id',
            'catatan' => 'nullable|string',
        ]);

        // Ambil disposisi dari Kepala
        $disposisi = Disposisi::where('surat_id', $request->surat_id)->first();

        if (!$disposisi) {
            return back()->with('error', 'Disposisi Kepala belum ada.');
        }

        // Simpan ke tabel distribusi_surats
        DistribusiSurat::create([
            'surat_id' => $request->surat_id,
            'bidang_tujuan' => $disposisi->kepada_bidang, // langsung ambil dari disposisi kepala
            'catatan_sekretaris' => $request->catatan,
        ]);

        // Ambil data surat untuk isi pesan
        $surat = SuratMasuk::findOrFail($request->surat_id);

        // Update status sekretaris → misalnya "didistribusikan"
        $surat->update([
            'status_sekretaris' => 'didistribusikan',
        ]);

        $pesan = "📩 *Surat Masuk Didistribusikan*\n"
            . "Dari Sekretaris ke Kabid\n\n"
            . "No. Surat: *{$surat->no_surat}*\n"
            . "Perihal: *{$surat->perihal}*\n"
            . "Tgl Masuk: *" . date('d M Y', strtotime($surat->tanggal_masuk)) . "*\n"
            . "Catatan Sekretaris: *" . ($request->catatan ?? '-') . "*\n\n"
            . "Silakan login untuk melihat detail:\n"
            . url('/');

        // Kirim WA ke Kabid
        $this->kirimWaKabid($pesan);

        return redirect()->route('sekretaris.dataSuratMasuk')
            ->with('success', 'Surat berhasil didistribusikan');
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
