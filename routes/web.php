<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LaporanController;

// Public routes
Route::get('/', function () {
    return view('home');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    // Routes grouped by roles
    Route::middleware('role:Unit-Kerja,Warga')->group(function () {
        Route::resource('Pengumuman', PengumumanController::class);
        Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
        Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
        
        Route::get('/Penerima', [PenerimaController::class, 'index']);
        Route::post('/penerima/bulk-update', [PenerimaController::class, 'bulkUpdate'])->name('penerima.bulkUpdate');
    });

    Route::middleware('role:Warga')->group(function () {
        Route::get('/Pendataan', [PendataanController::class, 'index']);
        Route::post('/pendataan', [PendataanController::class, 'store'])->name('pendataan.store');
    });

    Route::middleware('role:Unit-Kerja')->group(function () {
        Route::get('/Monitoring', [MonitoringController::class, 'index']);
        Route::post('/monitoring/store', [MonitoringController::class, 'store'])->name('monitoring.store');
    });

    Route::middleware('role:Unit-Kerja,Mentri-Sosial')->group(function () {
        Route::get('/Laporan', [LaporanController::class, 'index']);
        Route::get('/download-pdf', [LaporanController::class, 'downloadPdf'])->name('laporan.downloadPdf');
    });

});
