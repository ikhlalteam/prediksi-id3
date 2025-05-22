<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\RuleController;

use App\Http\Controllers\UserController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});


// ⛔️ Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ✅ Redirect berdasarkan role
Route::get('/redirect', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
})->middleware('auth');

// ✅ Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/prediksi/{id}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::post('/prediksi/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/prediksi/{id}', [AdminController::class, 'destroy'])->name('delete');
    Route::get('/export', [ExportController::class, 'export'])->name('export');

    // Perhitungan ID3
    Route::get('/rules/history', [RuleController::class, 'history'])->name('rules.history');
    Route::get('/rules/upload', [RuleController::class, 'uploadForm'])->name('rules.upload');
    Route::post('/rules/upload', [RuleController::class, 'upload'])->name('rules.upload.submit');
    Route::post('/rules/confirm', [RuleController::class, 'confirmUpdate'])->name('rules.confirm');

    // Profil admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

});


// ✅ User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PrediksiController::class, 'index'])->name('dashboard');
    Route::post('/prediksi', [PrediksiController::class, 'store'])->name('prediksi.store');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/photo', [UserPhotoController::class, 'update'])->name('profile.photo.update');
});


Route::prefix('admin/rules')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/upload', [RuleController::class, 'uploadForm'])->name('admin.rules.upload');
    Route::post('/upload', [RuleController::class, 'upload']);
    Route::post('/confirm', [RuleController::class, 'confirmUpdate'])->name('admin.rules.confirm');
    Route::post('/admin/rules/result', [RuleController::class, 'upload'])->name('admin.rules.result');
    Route::post('/admin/rules/save-history', [RuleController::class, 'saveToHistory'])->name('admin.rules.saveToHistory');
    Route::post('/admin/rules/save-history', [RuleController::class, 'saveHistory'])->name('admin.rules.saveHistory');



});



// 🧩 Auth routes dari Breeze
require __DIR__.'/auth.php';