<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FavoriteController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/questions', [QuestionController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::get('/questions/my', [QuestionController::class, 'myQuestions']);
    Route::put('/questions/{question}', [QuestionController::class, 'update']);
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);
    
    Route::post('/questions/{question}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
});
