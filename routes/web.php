<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BingoGameController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\CheckMaintenanceState;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AnonymoususerController;
use App\Http\Middleware\CheckUserPermission;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\EnsureAnonymousParticipant;
use App\Models\HomepagePost;
use App\Models\AnonymousParticipant;
use App\View\Components\redirect;
use Illuminate\Support\Facades\Broadcast;

// Laravel 9+
Broadcast::routes(['middleware' => ['web']]);

Route::get('/test', function() {
    return session()->get('room_id');
});

// Ou pour les versions antérieures
Route::post('/broadcasting/auth', function () {
    return Broadcast::auth(request());
})->middleware('web');

Route::get('cgu', function() {
    return view('cgu');
});

Route::get('test', function() {
    return view('layouts.app');
});

Route::middleware(SetLocale::class)->group(function() {
    Route::middleware(EnsureAnonymousParticipant::class)->group(function() {
        Route::get('/setname', [AnonymousUserController::class, 'set_name']);
        Route::post('/setname', [AnonymousUserController::class, 'register_name']);
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
            return view('unauth-home');
        }
    })->name('home');
    
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

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'show_your_profile'])->name('profile.you');
        Route::get('/{user}', [ProfileController::class, 'show_user_profile'])->name('profile.not_you');
    });

    Route::middleware([CheckUserPermission::class . ':'])->group(function () {
        Route::prefix('post')->group(function() {
            Route::get('/new', [PostsController::class, 'new'])->name('posts.new');
            Route::get('/edit/{post}', [PostsController::class, 'edit'])->name('posts.edit');
        });
    });

    Route::prefix('games')->group(function() {
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('new', [GamesController::class, 'new']);
            Route::post('new_post', [GamesController::class, 'store'])->name('games.new_post');
            Route::post('delete', [GamesController::class, 'delete'])->name('games.delete');
            Route::post('rename', [GamesController::class, 'rename'])->name('games.rename');
        });

        Route::get('list', [GamesController::class, 'list'])->name('games.list');

        Route::prefix('{game}')->group(function() {
            Route::get('', [GamesController::class,'show']);

            Route::middleware(['auth', 'verified'])->group(function () {
                Route::post('/flag', [GamesController::class, 'flag'])->name('game.flag');

                Route::get('/objective', [ObjectivesController::class, 'new']);
                Route::post('/objective', [ObjectivesController::class, 'post']);

                Route::post('set_visibility', [GamesController::class, 'set_visibility'])->name('game.set_visibility');
                Route::post('set_language', [GamesController::class, 'set_language'])->name('game.set_language');
                Route::post('change_image', [GamesController::class, 'change_image'])->name('games.change_image');
            });
        });
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::prefix('objectives')->group(function() {
            Route::get('{objective}/edit', [ObjectivesController::class,'edit']);
            Route::post('{objective}/edit_post', [ObjectivesController::class,'edit_post']);
            Route::get('{id}/delete', [ObjectivesController::class,'delete']);    
        });
    });

    Route::prefix('room')->group(function() {
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('start', [RoomController::class,'start']);
            Route::post('start', [RoomController::class,'start_post']);
            
            Route::get('setup', [RoomController::class, 'setup']);
            Route::post('setup', [RoomController::class,'setup_post']);

            Route::post('begin', [RoomController::class,'begin'])->name('room-start');
        });

        Route::middleware([EnsureAnonymousParticipant::class])->group(function() {
            Route::get('wait', [RoomController::class,'wait']);
        });

        Route::get('play', [RoomController::class, 'play']);

        Route::get('/results', [RoomController::class, 'results'])->name('room.results');
    });

});


require __DIR__.'/auth.php';
