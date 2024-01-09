<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;



Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/', [PostController::class, 'showAllPosts']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'update']);
Route::delete('/delete-post/{post}', [PostController::class, 'destroy']);

//Comment routes
Route::post('/create-comment/{post}', [CommentController::class, 'createCommemt'])->name('createCommemt');
Route::delete('/delete-comment/{comment}', [CommentController::class, 'deleteComment'])->name('deleteComment');
