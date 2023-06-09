<?php

use App\Http\Controllers\{DashboardController, ProfileController, QuestionController, Quetion\LikeController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return  to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::post('question', [QuestionController::class, 'store'])->name('question.store');
Route::post('question/like/{question}', LikeController::class)->name('question.like');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
