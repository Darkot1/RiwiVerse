<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/general', function () {
    return Inertia::render('General');
})->middleware(['auth', 'verified'])->name('general');

Route::get('/amigos', function () {
    return Inertia::render('Friends');
})->middleware(['auth', 'verified'])->name('friends');

Route::get('/personal', function () {
    return Inertia::render('Private');
})->middleware(['auth', 'verified'])->name('private');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});









require __DIR__.'/auth.php';
