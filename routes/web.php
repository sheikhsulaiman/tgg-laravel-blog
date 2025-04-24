<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Homepage - Show all posts
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Post Routes (using resource controller)
Route::resource('posts', PostController::class)->except(['index']); // 'index' is already defined above

// Comment Routes
// Store a new comment for a specific post
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
// Show edit form for a specific comment
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
// Update a specific comment
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
// Delete a specific comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');