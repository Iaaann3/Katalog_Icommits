<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplicationController; // HAPUS \Admin

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Auth::routes();

// Admin routes - GUNAKAN pages.admin.
Route::middleware(['auth'])->prefix('admin')->name('pages.admin.')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [ApplicationController::class, 'index'])->name('dashboard');
    
    // CRUD Applications
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('store');
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('edit');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('update');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('destroy');
    
});

Route::get('/detail/{slug}', function ($slug) {
    $application = \App\Models\Application::where('slug', $slug)
        ->where('status', true)
        ->firstOrFail();
    return view('detail.show', compact('application'));
})->name('detail.show');