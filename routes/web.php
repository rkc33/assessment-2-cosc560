<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', fn() => redirect('/admin/posts/all'));

// Route::get('/', function () {
//     return view('home');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin area (must be logged in + admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // POSTS
    Route::prefix('posts')->group(function () {
        Route::get('/all',   [PostController::class, 'index'])->name('admin.posts.all');      // list
        Route::get('/create',[PostController::class, 'create'])->name('admin.posts.create');  // form
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');  // form
        Route::post('/save', [PostController::class, 'save'])->name('admin.posts.save');      // create or update
        Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete'); // delete
    });

    // CATEGORIES
    Route::prefix('categories')->group(function () {
        Route::get('/all',   [CategoryController::class, 'index'])->name('admin.categories.all');
        Route::get('/create',[CategoryController::class, 'create'])->name('admin.categories.create');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/save', [CategoryController::class, 'save'])->name('admin.categories.save');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    });
});
