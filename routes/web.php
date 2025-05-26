<?php

use App\Http\Controllers\BingoGameController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    if(auth()->check()) {
        return view('auth-home');
    } else {
        return redirect('/login');
    }
})->name('home');

Route::post('/join', [RoomController::class,'join']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('games')->group(function() {
        Route::get('new', [GamesController::class, 'new']);
        Route::post('new_post', [GamesController::class, 'store'])->name('games.new_post');

        Route::post('delete', [GamesController::class, 'delete'])->name('games.delete');

        Route::get('list', [GamesController::class, 'list'])->name('games.list');

        Route::prefix('{game}')->group(function() {
            Route::get('', [GamesController::class,'show']);

            Route::get('/objective', [ObjectivesController::class, 'new']);
            Route::post('/objective', [ObjectivesController::class, 'post']);
        });
    });

    Route::prefix('objectives')->group(function() {
        Route::get('{id}/delete', [ObjectivesController::class,'delete']);
    });

    Route::get('start', [BingoGameController::class,'start']);
    Route::post('start', [BingoGameController::class,'start_post']);

    Route::prefix('room')->group(function() {
        Route::get('setup', [RoomController::class, 'setup']);
        Route::post('setup', [RoomController::class,'setup_post']);

        Route::get('wait', [RoomController::class,'wait']);

        Route::post('start', [RoomController::class,'start'])->name('room-start');
        Route::get('play', [RoomController::class, 'play']);

    });
});

require __DIR__.'/auth.php';
