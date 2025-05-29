<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('auth')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{slug}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/create', [ChatController::class, 'create'])->name('chat.create');
    Route::post('/message/create', [MessageController::class, 'create'])->name('message.create');
    Route::delete('/message/{message}/delete', [MessageController::class, 'delete'])->name('message.delete');
    Route::post('/search', SearchController::class);
    Route::get('/chat/{chat}/read', [ChatController::class, 'readMessages'])->name('chat.read');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
