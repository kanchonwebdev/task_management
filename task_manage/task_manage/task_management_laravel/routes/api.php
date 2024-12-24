<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskapiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// Register API
Route::post('register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'user' => $user,
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
});

// Login API
Route::post('login', function (Request $request) {
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'user' => $user,
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
});

// Task Routes for API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('task/index', [TaskapiController::class, 'index'])->name('taskapi.task.index');
    Route::post('task/store', [TaskapiController::class, 'store'])->name('taskapi.task.store');
    Route::get('task/view/{id}', [TaskapiController::class, 'show'])->name('taskapi.task.view');
    Route::put('task/update/{id}', [TaskapiController::class, 'update'])->name('taskapi.task.update');
    Route::delete('task/destroy/{id}', [TaskapiController::class, 'destroy'])->name('taskapi.task.destroy');
});
