<?php

use App\Http\Controllers\BingoGameController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () { return view('unauth-home'); })->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('games')->group(function() {
        Route::get('new', [GamesController::class, 'new']);
        Route::post('new/post', [GamesController::class, 'store']);

        Route::get('list', [GamesController::class, 'list']);

        Route::prefix('{game}')->group(function() {
            Route::get('', [GamesController::class,'show']);

            Route::get('/objective', [ObjectivesController::class, 'new']);
            Route::post('/objective/post', [ObjectivesController::class, 'post']);
        });
    });

    Route::get('start', [BingoGameController::class,'start'])->name('bingo.start');
});

require __DIR__.'/auth.php';
