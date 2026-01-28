<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', [QuestionController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return 'Welcome ' . auth()->user()->name;
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Questions (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/my-questions', [QuestionController::class, 'myQuestions'])
        ->name('questions.mine');




    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])
        ->name('questions.edit');

    Route::put('/questions/{question}', [QuestionController::class, 'update'])
        ->name('questions.update');

    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])
        ->name('questions.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/questions/{question}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});


Route::middleware('auth')->group(function () {
    // Store new comment
    Route::post('/questions/{question}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

    // Edit form
    Route::get('/comments/{comment}/edit', [\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');

    // Update comment
    Route::put('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');

    // Delete comment
    Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
});
