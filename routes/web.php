<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BingoGameController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Middleware\CheckUserPermission;

Route::get('/', function () {
    if(auth()->check()) {
        return view('auth-home');
    } else {
        return redirect('/login');
    }
})->name('home');

Route::post('/join', [RoomController::class,'join']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group([
        'prefix' => 'admin',
        'middleware' => [
            CheckUserPermission::class . ':'
        ]
        ], function() {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::post('/join', [AdminController::class, 'join_room'])->name('admin.join_room');
        }
    );

    Route::prefix('games')->group(function() {
        Route::get('new', [GamesController::class, 'new']);
        Route::post('new_post', [GamesController::class, 'store'])->name('games.new_post');

        Route::post('delete', [GamesController::class, 'delete'])->name('games.delete');
        Route::post('rename', [GamesController::class, 'rename'])->name('games.rename');

        Route::get('list', [GamesController::class, 'list'])->name('games.list');

        Route::prefix('{game}')->group(function() {
            Route::get('', [GamesController::class,'show']);

            Route::get('/objective', [ObjectivesController::class, 'new']);
            Route::post('/objective', [ObjectivesController::class, 'post']);
        });
    });

    Route::prefix('objectives')->group(function() {
        Route::get('{objective}/edit', [ObjectivesController::class,'edit']);
        Route::post('{objective}/edit_post', [ObjectivesController::class,'edit_post']);
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
