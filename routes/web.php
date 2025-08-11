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
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\SekretarisDistribusiController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UsersController;

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
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
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
    Route::get('/admin/suratmasuk/selesai', [AdminController::class, 'arsip_surat'])->name('admin.suratmasuk.selesai');
});


// === Kepala Badan ===
Route::middleware(['auth', 'role:Kepala Badan'])->group(function () {
    Route::get('/kepala/dashboard', fn() => view('kepala.dashboard'))->name('kepala.dashboard');
    Route::get('/kepala/dataSuratMasuk', [KepalaController::class, 'dataSuratMasuk'])->name('kepala.dataSuratMasuk');
    Route::get('/kepala/suratmasuk/{id}/detail', [KepalaController::class, 'show'])->name('kepala.suratmasuk.detail');
    Route::post('/kepala/disposisi/simpan', [DisposisiController::class, 'store'])->name('kepala.suratmasuk.disposisi');
});


// === Sekretaris ===
Route::middleware(['auth', 'role:Sekretaris'])->group(function () {
    Route::get('/sekretaris/dashboard', fn() => view('sekretaris.dashboard'))->name('sekretaris.dashboard');
    Route::get('/sekretaris/dataSuratMasuk', [SekretarisController::class, 'dataSuratMasuk'])->name('sekretaris.dataSuratMasuk');
    Route::get('/sekretaris/suratmasuk/{id}/detail', [SekretarisController::class, 'show'])->name('sekretaris.suratmasuk.detail');
    Route::get('/sekretaris/disposisi/{id}/detail', [SekretarisController::class, 'detailDisposisi'])->name('sekretaris.disposisi.detail');
    Route::post('/sekretaris/suratmasuk/distribusi', [SekretarisController::class, 'storeDistribusi'])->name('sekretaris.suratmasuk.storeDistribusi');
});


// === Bidang Aset ===
Route::middleware(['auth', 'role:Bidang Asset'])->group(function () {
    Route::get('/asset/dashboard', fn() => view('asset.dashboard'))->name('asset.dashboard');
    Route::get('/asset/disposisi', [DisposisiController::class, 'disposisiAsset'])->name('asset.disposisi.index');
    Route::get('/asset/disposisi/{id}/detail', [DisposisiController::class, 'detailAsset'])->name('asset.disposisi.detail');
    Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai'])->name('kabid.disposisi.selesai');    
});


// === Bidang Akuntansi ===
Route::middleware(['auth', 'role:Bidang Akuntansi'])->group(function () {
    Route::get('/akuntansi/dashboard', fn() => view('akuntansi.dashboard'))->name('akuntansi.dashboard');
    Route::get('/akuntansi/disposisi', [DisposisiController::class, 'disposisiAkuntansi'])->name('akuntansi.disposisi.index');
    Route::get('/akuntansi/disposisi/{id}/detail', [DisposisiController::class, 'detailAkuntansi'])->name('akuntansi.disposisi.detail');
    Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai'])
    ->name('kabid.disposisi.selesai');
});


// === Bidang Anggaran ===
Route::middleware(['auth', 'role:Bidang Anggaran'])->group(function () {
    Route::get('/anggaran/dashboard', fn() => view('anggaran.dashboard'))->name('anggaran.dashboard');
    Route::get('/anggaran/disposisi', [DisposisiController::class, 'disposisiAnggaran'])->name('anggaran.disposisi.index');
    Route::get('/anggaran/disposisi/{id}/detail', [DisposisiController::class, 'detailAnggaran'])->name('anggaran.disposisi.detail');
    Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai'])
    ->name('kabid.disposisi.selesai');

});


// === Bidang Pembendaharaan ===
Route::middleware(['auth', 'role:Bidang Pembendaharaan'])->group(function () {
    Route::get('/pembendaharaan/dashboard', fn() => view('pembendaharaan.dashboard'))->name('pembendaharaan.dashboard');
    Route::get('/pembendaharaan/disposisi', [DisposisiController::class, 'disposisiPembendaharaan'])->name('pembendaharaan.disposisi.index');
    Route::get('/pembendaharaan/disposisi/{id}/detail', [DisposisiController::class, 'detailPembendaharaan'])->name('pembendaharaan.disposisi.detail');
    Route::get('/kabid/disposisi/selesai/{id}', [BidangController::class, 'selesai'])
    ->name('kabid.disposisi.selesai');
});


/*
|--------------------------------------------------------------------------
| Fallback Route (jika ada error URL tidak ditemukan)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
