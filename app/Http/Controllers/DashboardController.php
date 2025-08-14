<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\TrackingSurat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index1()
    {
        return view('layout.template');
    }
        
   public function index()
{
    $totalSuratMasuk = SuratMasuk::count();
    $totalPengguna = User::count();

    $suratMasukPerHari = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, COUNT(*) as total')
        ->where('tanggal_masuk', '>=', Carbon::now()->subDays(6))
        ->groupByRaw('DATE(tanggal_masuk)')
        ->orderBy('tanggal', 'ASC')
        ->get();

    $labels = $suratMasukPerHari->pluck('tanggal')->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('d M Y');
    });

    $data = $suratMasukPerHari->pluck('total');

    return view('admin.dashboard', compact(
        'totalSuratMasuk',
        'totalPengguna',
        'labels',
        'data'
    ));
}

}
