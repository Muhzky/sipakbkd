<?php

use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PangkatController;
use App\Http\Controllers\Admin\PegawaiController as AdminPegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Pimpinan\PengajuanController as PimpinanPengajuanController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kebijakan-privasi', function () {
    return view('pages.kebijakan-privasi');
})->name('kebijakan-privasi');

Route::get('/syarat-ketentuan', function () {
    return view('pages.syarat-ketentuan');
})->name('syarat-ketentuan');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
})->name('hubungi-kami');

Route::get('/panduan', function () {
    return view('pages.panduan');
})->name('panduan');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil', [ProfilController::class, 'update']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::put('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/{notification}/redirect', [NotificationController::class, 'redirect'])->name('notifications.redirect');

    Route::get('/dokumen/{dokumen}/{field}', [PengajuanController::class, 'downloadDokumen'])->name('dokumen.download');

    // Pegawai routes
    Route::middleware('role:Pegawai')->prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::get('/riwayat', [PengajuanController::class, 'riwayat'])->name('riwayat');
        Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
        Route::get('/pengajuan/{pengajuan}/edit-dokumen', [PengajuanController::class, 'editDokumen'])->name('pengajuan.edit-dokumen');
        Route::put('/pengajuan/{pengajuan}/dokumen', [PengajuanController::class, 'updateDokumen'])->name('pengajuan.update-dokumen');
        Route::get('/pengajuan/{pengajuan}/download-sk', [PengajuanController::class, 'downloadSk'])->name('pengajuan.download-sk');
    });

    // Admin routes
    Route::middleware('role:Admin BKD')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('pegawai', AdminPegawaiController::class);
        Route::resource('jabatan', JabatanController::class)->except(['show', 'create', 'edit']);
        Route::resource('pangkat', PangkatController::class)->except(['show', 'create', 'edit']);

        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{pengajuan}/verifikasi', [PengajuanController::class, 'verifikasi'])->name('pengajuan.verifikasi');
        Route::put('/pengajuan/{pengajuan}/status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.update-status');
        Route::get('/pengajuan/{pengajuan}/download-sk', [PengajuanController::class, 'downloadSk'])->name('pengajuan.download-sk');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/preview', [LaporanController::class, 'preview'])->name('laporan.preview');
        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
    });

    // Pimpinan routes
    Route::middleware('role:Pimpinan')->prefix('pimpinan')->name('pimpinan.')->group(function () {
        Route::get('/pengajuan', [PimpinanPengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{pengajuan}', [PimpinanPengajuanController::class, 'show'])->name('pengajuan.show');
        Route::put('/pengajuan/{pengajuan}/approve', [PimpinanPengajuanController::class, 'approve'])->name('pengajuan.approve');
        Route::put('/pengajuan/{pengajuan}/reject', [PimpinanPengajuanController::class, 'reject'])->name('pengajuan.reject');
        Route::get('/laporan', [LaporanController::class, 'pimpinanIndex'])->name('laporan.index');
        Route::get('/laporan/preview', [LaporanController::class, 'pimpinanPreview'])->name('laporan.preview');
    });
});
