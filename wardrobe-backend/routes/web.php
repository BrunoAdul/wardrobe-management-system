<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Add Sanctum CSRF Cookie Route
Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
