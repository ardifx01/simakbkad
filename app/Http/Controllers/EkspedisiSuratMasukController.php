<?php

namespace App\Http\Controllers;

use App\Models\EkspedisiSuratMasuk;
use Illuminate\Http\Request;

class EkspedisiSuratMasukController extends Controller
{
    public function index()
    {
        $ekspedisis = EkspedisiSuratMasuk::orderBy('tanggal', 'desc')->get();
        return view('admin.ekspedisiSurat', compact('ekspedisis'));
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
    public function show(EkspedisiSuratMasuk $ekspedisiSuratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EkspedisiSuratMasuk $ekspedisiSuratMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EkspedisiSuratMasuk $ekspedisiSuratMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EkspedisiSuratMasuk $ekspedisiSuratMasuk)
    {
        //
    }
}
