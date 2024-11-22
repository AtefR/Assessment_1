<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('quizzes', [\App\Http\Controllers\API\QuizController::class, 'index']);
Route::post('quiz-responses', [\App\Http\Controllers\API\QuizResponseController::class, 'store']);
