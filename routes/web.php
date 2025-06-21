<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BingoGameController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Middleware\CheckUserPermission;
use App\Http\Middleware\SetLocale;
use App\View\Components\redirect;

Route::get('cgu', function() {
    return view('cgu');
});

Route::middleware(SetLocale::class)->group(function() {
    Route::get('/lang', function() {
        dd([
            app()->getLocale(),
            session()->get('locale')
        ]);
    });
    
    Route::get('/lang/{locale}', function($locale) {
        if (in_array($locale, ['en', 'fr'])) {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang.switch');
    
    Route::get('/', function () {
        if(auth()->check()) {
            return view('auth-home');
        } else {
            return redirect('/login');
        }
    })->name('home');
    
    
    
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/join', [RoomController::class,'join']);
        
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

                Route::post('/flag', [GamesController::class, 'flag'])->name('game.flag');
    
                Route::get('/objective', [ObjectivesController::class, 'new']);
                Route::post('/objective', [ObjectivesController::class, 'post']);

                Route::post('set_visibility', [GamesController::class, 'set_visibility'])->name('game.set_visibility');
                Route::post('set_language', [GamesController::class, 'set_language'])->name('game.set_language');
            });
        });
    
        Route::prefix('objectives')->group(function() {
            Route::get('{objective}/edit', [ObjectivesController::class,'edit']);
            Route::post('{objective}/edit_post', [ObjectivesController::class,'edit_post']);
            Route::get('{id}/delete', [ObjectivesController::class,'delete']);    
        });
    
        Route::prefix('room')->group(function() {
            Route::get('start', [RoomController::class,'start']);
            Route::post('start', [RoomController::class,'start_post']);

            Route::get('setup', [RoomController::class, 'setup']);
            Route::post('setup', [RoomController::class,'setup_post']);
    
            Route::get('wait', [RoomController::class,'wait']);
    
            Route::post('begin', [RoomController::class,'begin'])->name('room-start');
            Route::get('play', [RoomController::class, 'play']);
        });
    });

});


require __DIR__.'/auth.php';
