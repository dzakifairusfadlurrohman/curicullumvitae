<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama redirect ke daftar pelamar publik
Route::get('/', function () {
    return redirect()->route('public.applicants.index');
});

// Public (tanpa login)
Route::get('/applicants', [ApplicantController::class, 'index'])->name('applicants.index');
Route::get('/applicants/{id}', [ApplicantController::class, 'show'])->name('public.applicants.show');

// Route untuk publik: lihat daftar & detail CV
Route::prefix('public')->name('public.')->group(function () {
    Route::resource('applicants', ApplicantController::class)
        ->only(['index', 'show'])
        ->names('applicants');
});

// Route dashboard untuk admin (login)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route untuk admin (login): tambah, edit, hapus data CV
Route::middleware('auth')->group(function () {
    Route::resource('admin/applicants', ApplicantController::class)
        ->except(['show']) // 👈 Hanya `show` yang di-exclude, bukan `index`
        ->names('admin.applicants');    

    // Profil dari Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routing autentikasi Breeze
require __DIR__.'/auth.php';
