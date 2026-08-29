<?php

use Illuminate\Support\Facades\Route;

// Untuk sekarang stub routing admin. Nanti disesuaikan dengan auth yang digunakan.
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('katalog', ProductController::class)->except(['show', 'create', 'edit']);
    Route::resource('edukasi', EducationController::class)->except(['show', 'create', 'edit']);
    Route::resource('kategori', CategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('tim', TeamController::class)->except(['show', 'create', 'edit']);
    
    // Pesan Masuk (Inbox)
    Route::get('/pesan', [MessageController::class, 'index'])->name('pesan.index');
    Route::post('/pesan/{id}/read', [MessageController::class, 'toggleRead'])->name('pesan.read');
    Route::delete('/pesan/{id}', [MessageController::class, 'destroy'])->name('pesan.destroy');
    
    Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [SettingController::class, 'update'])->name('pengaturan.update');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
});
