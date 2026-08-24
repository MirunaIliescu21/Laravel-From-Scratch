<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Placeholder for home page.';
});

// For all these routes we need to be authenticated -> middleware('auth")
Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index']);

    Route::get('/ideas/create', [IdeaController::class, 'create']);

    Route::post('/ideas', [IdeaController::class, 'store']);

    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);

    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);

    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);

    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);

    Route::delete('logout', [SessionController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create'])->middleware('guest'); // create a new session for register
    Route::post('/register', [RegisterUserController::class, 'store'])->middleware('guest');

    Route::get('/login', [SessionController::class, 'create'])->name("login"); // create a new session for login
    // we named the route for Laravel to know where to redirect in case of middleware
    Route::post('/login', [SessionController::class, 'store']);
});


