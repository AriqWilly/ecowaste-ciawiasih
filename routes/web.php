<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\EducationController;

Route::get('/', function () {
    $products = \App\Models\Product::where('is_published', true)->latest()->take(6)->get();
    $educations = \App\Models\EducationalContent::latest()->take(3)->get();
    return view('public.home', compact('products', 'educations'));
})->name('home');

Route::prefix('katalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('index');
    Route::get('/{slug}', [CatalogController::class, 'show'])->name('show');
});

Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');
Route::get('/edukasi/{slug}', [EducationController::class, 'show'])->name('education.show');

Route::view('/tentang-kami', 'public.about')->name('about');
use App\Http\Controllers\Public\ContactController;
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

// Authentication Routes
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

if (file_exists(__DIR__.'/admin.php')) {
    require __DIR__.'/admin.php';
}
