<?php

namespace App\Http\Controllers;

use App\Models\LoginHistories;
use App\Models\SuratMasuk;
use App\Models\TrackingSurat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index1()
    {
        return view('layout.template');
    }
//     public function index(Request $request)
// {
//     $totalSurat = SuratMasuk::count();
//     $totalArsipSurat = SuratMasuk::where('status_disposisi', 'Didisposisikan')->count();
//     $totalSuratMasuk = SuratMasuk::where('status_disposisi', 'Belum')->count();
//     $totalPengguna = User::where('is_active', '1')->count();
//     // $surats = SuratMasuk::latest()->get();
//     // $surats = SuratMasuk::with('disposisi')->latest()->get();
//     $surats = SuratMasuk::where(function ($q) {
//         // tampilkan semua surat yang belum selesai
//         $q->whereNull('tanggal_selesai')
//           ->orWhere('tanggal_selesai', '>=', now()->startOfDay());
//     })
//     ->latest()
//     ->get();

//     $steps = ['Kepala Badan', 'Sekretaris', 'Kepala', 'Selesai'];

//     $filter = $request->get('filter', 'harian');

//     if ($filter === 'mingguan') {
//         $suratMasuk = SuratMasuk::selectRaw('YEARWEEK(tanggal_masuk) as minggu, COUNT(*) as total')
//             ->where('tanggal_masuk', '>=', Carbon::now()->subWeeks(6))
//             ->groupBy('minggu')
//             ->orderBy('minggu', 'ASC')
//             ->get();

//         $labels = $suratMasuk->pluck('minggu')->map(function ($week) {
//             return "Minggu " . substr($week, -2); // contoh label Minggu 32
//         });
//         $data = $suratMasuk->pluck('total');

//     } elseif ($filter === 'bulanan') {
//         $suratMasuk = SuratMasuk::selectRaw('DATE_FORMAT(tanggal_masuk, "%Y-%m") as bulan, COUNT(*) as total')
//             ->where('tanggal_masuk', '>=', Carbon::now()->subMonths(6))
//             ->groupBy('bulan')
//             ->orderBy('bulan', 'ASC')
//             ->get();

//         $labels = $suratMasuk->pluck('bulan')->map(function ($bulan) {
//             return Carbon::parse($bulan . '-01')->format('M Y');
//         });
//         $data = $suratMasuk->pluck('total');

//     } else { // default harian
//         $suratMasuk = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, COUNT(*) as total')
//             ->where('tanggal_masuk', '>=', Carbon::now()->subDays(6))
//             ->groupBy('tanggal')
//             ->orderBy('tanggal', 'ASC')
//             ->get();

//         $labels = $suratMasuk->pluck('tanggal')->map(function ($date) {
//             return Carbon::parse($date)->format('d M Y');
//         });
//         $data = $suratMasuk->pluck('total');
//     }

//     return view('admin.dashboard', compact(
//         'labels', 
//         'data',
//         'filter',
//         'totalSuratMasuk',
//         'totalArsipSurat',
//         'totalSurat',
//         'totalPengguna',
//         'surats',
//         'steps',
//     ));
// }

public function index(Request $request)
{
    $totalSurat = SuratMasuk::count();
    $totalArsipSurat = SuratMasuk::where('status_disposisi', 'Didisposisikan')->count();
    $totalSuratMasuk = SuratMasuk::where('status_disposisi', 'Belum')->count();
    $totalPengguna = User::where('is_active', '1')->count();

    $steps = ['Kepala Badan', 'Sekretaris', 'Kepala', 'Selesai'];

    $filter     = $request->get('filter', 'harian');
    $tanggal    = $request->get('tanggal'); // ambil input tanggal dari form

    // Default query surat
    $querySurat = SuratMasuk::query();

    // Jika user pilih tanggal tertentu
    if ($tanggal) {
        $querySurat->whereDate('tanggal_masuk', $tanggal);
    }

    // Data untuk tabel
    $surats = $querySurat
        ->where(function ($q) {
            $q->whereNull('tanggal_selesai')
              ->orWhere('tanggal_selesai', '>=', now()->startOfDay());
        })
        ->latest()
        ->get();

    // Data untuk chart
    if ($tanggal) {
        // kalau ada tanggal dipilih, tampilkan hanya tanggal itu
        $suratMasuk = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, COUNT(*) as total')
            ->whereDate('tanggal_masuk', $tanggal)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $labels = $suratMasuk->pluck('tanggal')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        });
        $data = $suratMasuk->pluck('total');

    } elseif ($filter === 'mingguan') {
        $suratMasuk = SuratMasuk::selectRaw('YEARWEEK(tanggal_masuk) as minggu, COUNT(*) as total')
            ->where('tanggal_masuk', '>=', Carbon::now()->subWeeks(6))
            ->groupBy('minggu')
            ->orderBy('minggu', 'ASC')
            ->get();

        $labels = $suratMasuk->pluck('minggu')->map(function ($week) {
            return "Minggu " . substr($week, -2);
        });
        $data = $suratMasuk->pluck('total');

    } elseif ($filter === 'bulanan') {
        $suratMasuk = SuratMasuk::selectRaw('DATE_FORMAT(tanggal_masuk, "%Y-%m") as bulan, COUNT(*) as total')
            ->where('tanggal_masuk', '>=', Carbon::now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan', 'ASC')
            ->get();

        $labels = $suratMasuk->pluck('bulan')->map(function ($bulan) {
            return Carbon::parse($bulan . '-01')->format('M Y');
        });
        $data = $suratMasuk->pluck('total');

    } else {
        $suratMasuk = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, COUNT(*) as total')
            ->where('tanggal_masuk', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $labels = $suratMasuk->pluck('tanggal')->map(function ($date) {
            return Carbon::parse($date)->format('d M Y');
        });
        $data = $suratMasuk->pluck('total');
    }
    $suratPerKategori = SuratMasuk::select('kategori_agenda', DB::raw('COUNT(*) as total'))
        ->groupBy('kategori_agenda')
        ->pluck('total', 'kategori_agenda');

    // Ganti nama variabel
    $kategoriLabels = $suratPerKategori->keys();   // ['LS', 'GU', 'LAINNYA']
    $kategoriData   = $suratPerKategori->values(); // [10, 5, 20]

    return view('admin.dashboard', compact(
        'labels', 
        'data',
        'filter',
        'tanggal',
        'totalSuratMasuk',
        'totalArsipSurat',
        'totalSurat',
        'totalPengguna',
        'surats',
        'steps',
        'kategoriLabels', 
        'kategoriData'
    ));
}


        
//    public function index()
// {
//     $totalSurat = SuratMasuk::count();
//     $totalArsipSurat = SuratMasuk::where('status_disposisi', 'Didisposisikan')->count();
//     $totalSuratMasuk = SuratMasuk::where('status_disposisi', 'Belum')->count();
//     $totalPengguna = User::count();
//     // $surats = SuratMasuk::latest()->get();
//     // $surats = SuratMasuk::with('disposisi')->latest()->get();
//     $surats = SuratMasuk::where(function ($q) {
//         // tampilkan semua surat yang belum selesai
//         $q->whereNull('tanggal_selesai')
//           ->orWhere('tanggal_selesai', '>=', now()->startOfDay());
//     })
//     ->latest()
//     ->get();

//     $steps = ['Kepala Badan', 'Sekretaris', 'Kepala', 'Selesai'];

//     $suratMasukPerHari = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, COUNT(*) as total')
//         ->where('tanggal_masuk', '>=', Carbon::now()->subDays(6))
//         ->groupByRaw('DATE(tanggal_masuk)')
//         ->orderBy('tanggal', 'ASC')
//         ->get();

//     $labels = $suratMasukPerHari->pluck('tanggal')->map(function ($date) {
//         return \Carbon\Carbon::parse($date)->format('d M Y');
//     });

//     $data = $suratMasukPerHari->pluck('total');

//     return view('admin.dashboard', compact(
//         'totalSuratMasuk',
//         'totalArsipSurat',
//         'totalSurat',
//         'totalPengguna',
//         'labels',
//         'data',
//         'surats',
//         'steps'
//     ));
// }

}
