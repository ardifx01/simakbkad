<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    // Menampilkan halaman form tindak lanjut
    public function create($id)
    {
        $disposisi = Disposisi::with('surat')->findOrFail($id);
        return view('asset.tindaklanjut.create', compact('disposisi'));
    }

    // Generate PDF surat balasan
    public function store(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'sifat'       => 'required|string|max:100',
            'lampiran'    => 'required|string|max:255',
            'hal'         => 'required|string|max:255',
            'isi_balasan' => 'required|string',
        ]);

        $disposisi = Disposisi::with('surat')->findOrFail($id);

        $data = [
            'disposisi'    => $disposisi,
            'nomor_surat'  => $request->nomor_surat,
            'sifat'        => $request->sifat,
            'lampiran'     => $request->lampiran,
            'hal'          => $request->hal,
            'isi_balasan'  => $request->isi_balasan,
            'tanggal_surat' => now()->format('d F Y'), // Bisa disesuaikan
        ];

        // PDF View
        $pdf = Pdf::loadView('asset.tindaklanjut.pdf', $data);

        return $pdf->download('Surat-Balasan.pdf');
    }
}
