<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\Bidang;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    public function selesai($id)
    {
        // Cari surat
        $surat = SuratMasuk::findOrFail($id);

        // Cek kalau sudah selesai, jangan update lagi
        if ($surat->status_kabid == 'Selesai') {
            return redirect()->back()->with('info', 'Surat ini sudah selesai sebelumnya.');
        }

        // Update status kabid
        $surat->update([
            'status_kabid' => 'Selesai'
        ]);

        return redirect()->back()->with('success', 'Surat telah ditandai sebagai selesai.');
    }
    public function selesai1($id)
    {
        // Cari surat
        $surat = SuratMasuk::findOrFail($id);

        // Cek kalau sudah selesai, jangan update lagi
        if ($surat->status_kabid == 'Selesai') {
            return redirect()->back()->with('info', 'Surat ini sudah selesai sebelumnya.');
        }

        // Update status kabid
        $surat->update([
            'status_kabid' => 'Selesai'
        ]);

        return redirect()->back()->with('success', 'Surat telah ditandai sebagai selesai.');
    }
    public function selesai2($id)
    {
        // Cari surat
        $surat = SuratMasuk::findOrFail($id);

        // Cek kalau sudah selesai, jangan update lagi
        if ($surat->status_kabid == 'Selesai') {
            return redirect()->back()->with('info', 'Surat ini sudah selesai sebelumnya.');
        }

        // Update status kabid
        $surat->update([
            'status_kabid' => 'Selesai'
        ]);

        return redirect()->back()->with('success', 'Surat telah ditandai sebagai selesai.');
    }
    public function selesai3($id)
    {
        // Cari surat
        $surat = SuratMasuk::findOrFail($id);

        // Cek kalau sudah selesai, jangan update lagi
        if ($surat->status_kabid == 'Selesai') {
            return redirect()->back()->with('info', 'Surat ini sudah selesai sebelumnya.');
        }

        // Update status kabid
        $surat->update([
            'status_kabid' => 'Selesai'
        ]);

        return redirect()->back()->with('success', 'Surat telah ditandai sebagai selesai.');
    }


    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bidang $bidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidang $bidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidang $bidang)
    {
        //
    }
}
