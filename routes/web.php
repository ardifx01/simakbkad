<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Bidang\AdminController;
use App\Http\Controllers\Bidang\KepalaController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\EkspedisiSuratMasukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\SekretarisDistribusiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UsersController;
use App\Models\EkspedisiSuratMasuk;
use App\Models\SuratMasuk;
use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| AUTH (Login & Register)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/landing', [LoginController::class, 'showLanding'])->name('landing');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD PER ROLE
|--------------------------------------------------------------------------
*/

// === Admin ===
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/admin/dashboard', function () {
    //     $totalSuratMasuk = SuratMasuk::count();
    //     $totalPengguna = User::count();
    //     // Ambil data 7 hari terakhir
    //     $suratMasukPerHari = SuratMasuk::selectRaw('DATE(tanggal_masuk) as tanggal_masuk, COUNT(*) as total')
    //         ->where('tanggal_masuk', '>=', Carbon::now()->subDays(6)) // 7 hari terakhir
    //         ->groupBy('tanggal_masuk')
    //         ->orderBy('tanggal_masuk', 'ASC')
    //         ->get();

    //     $labels = $suratMasukPerHari->pluck('tanggal_masuk'); // Tanggal
    //     $data = $suratMasukPerHari->pluck('total');     // Total surat

    //     return view('admin.dashboard', compact('totalSuratMasuk', 'totalPengguna', 'labels', 'data'));
    // })->name('admin.dashboard');
    Route::get('/admin/suratMasuk', [AdminController::class, 'surat_masuk'])->name('admin.input_surat');
    Route::get('/admin/dataSuratMasuk', [AdminController::class, 'data_surat'])->name('admin.dataSuratMasuk');
    Route::get('/admin/dataSuratMasuk', [AdminController::class, 'dataSuratMasuk'])->name('admin.dataSuratMasuk');
    Route::post('/admin/suratmasuk/store', [AdminController::class, 'store'])->name('admin.suratmasuk.store');
    Route::get('/admin/suratmasuk/{id}/detail', [AdminController::class, 'show'])->name('admin.suratmasuk.detail');
    Route::get('/admin/disposisi', [DisposisiController::class, 'index'])->name('admin.suratmasuk.disposisi');
    Route::get('/admin/disposisi/detail/{id}', [DisposisiController::class, 'detail'])->name('admin.disposisi.detail');
    Route::get('/admin/users', [AdminController::class, 'showUser'])->name('admin.users.index');
    Route::delete('/admin/user/{id}', [UsersController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/admin/tambahUser', [UsersController::class, 'index'])->name('admin.tambahPengguna');
    Route::post('/admin/tambahUser', [UsersController::class, 'store'])->name('admin.user.store');
    Route::patch('/admin/user/{id}/toggle', [UsersController::class, 'toggleStatus'])->name('admin.user.toggleStatus');
    Route::get('/admin/user/{id}/edit', [UsersController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UsersController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/suratmasuk/arsip', [AdminController::class, 'arsip_surat'])->name('admin.suratmasuk.selesai');
    Route::get('/admin/suratmasuk/ekspedisi', [EkspedisiSuratMasukController::class, 'index'])->name('admin.ekspedisi.index');
    Route::delete('/admin/suratmasuk/{id}', [AdminController::class, 'destroy'])->name('admin.suratmasuk.destroy');
    Route::get('admin/suratmasuk/{id}/edit', [AdminController::class, 'edit'])->name('admin.suratmasuk.edit');
    Route::put('admin/suratmasuk/{id}', [AdminController::class, 'update'])->name('admin.suratmasuk.update');
});

// === Kepala Badan ===
Route::middleware(['auth', 'role:Kepala Badan'])->group(function () {
    Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');
    // Route::get('/kepala/dashboard', fn() => view('kepala.dashboard'))->name('kepala.dashboard');
    Route::get('/kepala/dataSuratMasuk', [KepalaController::class, 'dataSuratMasuk'])->name('kepala.dataSuratMasuk');
    Route::get('/kepala/suratmasuk/{id}/detail', [KepalaController::class, 'show'])->name('kepala.suratmasuk.detail');
    Route::post('/kepala/disposisi/simpan', [DisposisiController::class, 'store'])->name('kepala.suratmasuk.disposisi');
    Route::get('/kepala/suratmasuk/arsip', [KepalaController::class, 'arsip_surat'])->name('kepala.suratmasuk.selesai');
});

// === Sekretaris ===
Route::middleware(['auth', 'role:Sekretaris'])->group(function () {
    // Route::get('/sekretaris/dashboard', fn() => view('sekretaris.dashboard'))->name('sekretaris.dashboard');
    Route::get('/sekretaris/dashboard', [SekretarisController::class, 'index'])->name('sekretaris.dashboard');
    Route::get('/sekretaris/dataSuratMasuk', [SekretarisController::class, 'dataSuratMasuk'])->name('sekretaris.dataSuratMasuk');
    Route::get('/sekretaris/suratmasuk/{id}/detail', [SekretarisController::class, 'show'])->name('sekretaris.suratmasuk.detail');
    Route::get('/sekretaris/disposisi/{id}/detail', [SekretarisController::class, 'detailDisposisi'])->name('sekretaris.disposisi.detail');
    Route::post('/sekretaris/suratmasuk/distribusi', [SekretarisController::class, 'storeDistribusi'])->name('sekretaris.suratmasuk.storeDistribusi');
    Route::get('/sekretaris/suratmasuk/arsip', [SekretarisController::class, 'arsip_surat'])->name('sekretaris.suratmasuk.selesai');
});


// === Bidang Aset ===
Route::middleware(['auth', 'role:Bidang Asset'])->group(function () {
    Route::get('/asset/dashboard', fn() => view('asset.dashboard'))->name('asset.dashboard');
    Route::get('/asset/disposisi', [DisposisiController::class, 'disposisiAsset'])->name('asset.disposisi.index');
    Route::get('/asset/disposisi/{id}/detail', [DisposisiController::class, 'detailAsset'])->name('asset.disposisi.detail');
    Route::get('/asset/suratmasuk/arsip', [DisposisiController::class, 'arsip_surat_asset'])->name('asset.suratmasuk.selesai');
    // Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai1'])->name('kabid.disposisi.selesai');    
});


// === Bidang Akuntansi ===
Route::middleware(['auth', 'role:Bidang Akuntansi'])->group(function () {
    Route::get('/akuntansi/dashboard', fn() => view('akuntansi.dashboard'))->name('akuntansi.dashboard');
    Route::get('/akuntansi/disposisi', [DisposisiController::class, 'disposisiAkuntansi'])->name('akuntansi.disposisi.index');
    Route::get('/akuntansi/disposisi/{id}/detail', [DisposisiController::class, 'detailAkuntansi'])->name('akuntansi.disposisi.detail');
    Route::get('/akuntansi/suratmasuk/arsip', [DisposisiController::class, 'arsip_surat_akuntansi'])->name('akuntansi.suratmasuk.selesai');
    // Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai2'])->name('kabid.disposisi.selesai');
});


// === Bidang Anggaran ===
Route::middleware(['auth', 'role:Bidang Anggaran'])->group(function () {
    Route::get('/anggaran/dashboard', fn() => view('anggaran.dashboard'))->name('anggaran.dashboard');
    Route::get('/anggaran/disposisi', [DisposisiController::class, 'disposisiAnggaran'])->name('anggaran.disposisi.index');
    Route::get('/anggaran/disposisi/{id}/detail', [DisposisiController::class, 'detailAnggaran'])->name('anggaran.disposisi.detail');
    Route::get('/anggaran/suratmasuk/arsip', [DisposisiController::class, 'arsip_surat_anggaran'])->name('anggaran.suratmasuk.selesai');
    // Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai3'])->name('kabid.disposisi.selesai');

});


// === Bidang Pembendaharaan ===
Route::middleware(['auth', 'role:Bidang Pembendaharaan'])->group(function () {
    Route::get('/pembendaharaan/dashboard', fn() => view('pembendaharaan.dashboard'))->name('pembendaharaan.dashboard');
    Route::get('/pembendaharaan/disposisi', [DisposisiController::class, 'disposisiPembendaharaan'])->name('pembendaharaan.disposisi.index');
    Route::get('/pembendaharaan/disposisi/{id}/detail', [DisposisiController::class, 'detailPembendaharaan'])->name('pembendaharaan.disposisi.detail');
    Route::get('/bendahara/suratmasuk/arsip', [DisposisiController::class, 'arsip_surat_bendahara'])->name('bendahara.suratmasuk.selesai');
    // Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai4'])->name('kabid.disposisi.selesai');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/disposisi/selesai/{id}', [BidangController::class, 'selesai'])->name('kabid.disposisi.selesai');
});




/*
|--------------------------------------------------------------------------
| Fallback Route (jika ada error URL tidak ditemukan)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Route::get('/test-backblaze', function () {
//     // Upload file ke Backblaze
//     Storage::disk('s3')->put('coba.txt', 'Halo dari Laravel ke Backblaze!');
    
//     // Ambil URL file
//     $url = Storage::disk('s3')->url('coba.txt');
    
//     return $url;
// });