<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tenant\PostController;
use App\Http\Middleware\UseTenantConnection;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', UseTenantConnection::class])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Other routes (create, store, etc.)
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

require __DIR__ . '/auth.php';
