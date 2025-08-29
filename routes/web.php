<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

// Default landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Auth::routes();

// After login -> dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// ===============================
// Admin Protected CRUD Routes
// ===============================
Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {

    // Posts Routes
    Route::get('/posts/all', [PostController::class, 'index'])->name('posts.all');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/save', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');

    // Categories Routes
    Route::get('/categories/all', [CategoryController::class, 'index'])->name('categories.all');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/save', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
});
    
// User-only routes
// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/my-posts', [PostController::class, 'userPosts'])->name('posts.user');
// });
