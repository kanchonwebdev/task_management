<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/old', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth'])->group(function () {
    /* task controller */
    Route::get('task/index', [TaskController::class, 'index'])->name('task.index');
    Route::get('task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('task/view/{id}', [TaskController::class, 'show'])->name('task.view');
    Route::get('task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('task/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('task/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
