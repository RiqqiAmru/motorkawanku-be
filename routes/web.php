<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'create'])->name('users.create');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
