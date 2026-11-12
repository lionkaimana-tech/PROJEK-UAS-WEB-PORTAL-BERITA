<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;


// Rute untuk menghapus komentar berdasarkan ID komentar
Route::delete('/admin/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
// Halaman Publik (Beranda, Detail Berita, Kategori, dan Komentar)
Route::get('/', [HomeController::class, 'index']);
Route::get('/berita/{post:slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/kategori/{category:slug}', [HomeController::class, 'category'])->name('category.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// Rute Login Publik
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Admin (Dilindungi Middleware 'auth' agar wajib login)
Route::prefix('admin')->name('admin.posts.')->middleware('auth')->group(function () {
    Route::get('/posts', [AdminPostController::class, 'index'])->name('index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('store');
    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('destroy');
});