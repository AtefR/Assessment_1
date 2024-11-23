<?php

use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizResponseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('quizzes', QuizController::class)->names('quizzes');
    Route::resource('quiz-responses', QuizResponseController::class)->names('quiz-responses');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{quiz}', [HomeController::class, 'show'])->name('quiz.show');
Route::post('/{quiz}', [HomeController::class, 'store'])->name('quiz-response.store');
