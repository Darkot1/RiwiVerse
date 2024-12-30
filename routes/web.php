<?php

use App\Http\Controllers\Post\PostController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas principales
    Route::get('/general', [PostController::class, 'index'])->name('general');
    
    Route::get('/amigos', function () {
        return Inertia::render('Friends');
    })->name('friends');

    Route::get('/personal', function () {
        return Inertia::render('Private');
    })->name('private');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de posts
    Route::prefix('posts')->group(function () {
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});

require __DIR__.'/auth.php';
