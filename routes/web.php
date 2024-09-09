<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LaporanController;

// Modifikasi route untuk '/'
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes for Unit-Kerja and Warga
    Route::middleware('role:Unit-Kerja,Warga')->group(function () {
        Route::resource('Pengumuman', PengumumanController::class);
    });

    // Routes for Warga
    Route::middleware('role:Warga')->group(function () {
        Route::resource('Pendataan', PendataanController::class);
    });

    // Routes for Unit-Kerja
    Route::middleware('role:Unit-Kerja')->group(function () {
        Route::resource('Penerima', PenerimaController::class);
        Route::post('/penerima/bulk-update', [PenerimaController::class, 'bulkUpdate'])->name('penerima.bulkUpdate');

        Route::get('/Monitoring', [MonitoringController::class, 'index'])->name('Monitoring.index');
        Route::post('/Monitoring', [MonitoringController::class, 'store'])->name('Monitoring.store');
    });

    // Routes for Unit-Kerja and Mentri-Sosial
    Route::middleware('role:Unit-Kerja,Mentri-Sosial')->group(function () {
        Route::get('/Laporan', [LaporanController::class, 'index'])->name('Laporan.index');
        Route::get('/download-pdf', [LaporanController::class, 'downloadPdf'])->name('laporan.downloadPdf');
    });

    // Pengumuman routes
    Route::resource('pengumuman', PengumumanController::class);

    // Penerima routes
    Route::resource('penerima', PenerimaController::class);
    Route::post('/penerima/bulk-update', [PenerimaController::class, 'bulkUpdate'])->name('penerima.bulkUpdate');
    Route::get('/penerima/search', [PenerimaController::class, 'search'])->name('penerima.search');
});
