<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public home
Route::get('/', [QuestionController::class, 'home'])->name('home');

// Protected routes
Route::middleware('auth')->group(function () {

    // Questions - static routes MUST come before dynamic {question} routes
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::get('/questions/favorites', [FavoriteController::class, 'index'])->name('questions.favorites');
    Route::get('/my-questions', [QuestionController::class, 'myQuestions'])->name('questions.mine');

    // Questions - dynamic routes
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle'])->name('questions.favorite');
    Route::post('/questions/{question}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Comments
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});
