<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Members Routes
    Route::resource('members', \App\Http\Controllers\MemberController::class);
    Route::get('/members/{member}/renew', [\App\Http\Controllers\MemberController::class, 'renew'])->name('members.renew');
    Route::post('/members/{member}/renew', [\App\Http\Controllers\MemberController::class, 'storeRenewal'])->name('members.storeRenewal');

    // Training Types & Plans Routes
    Route::resource('training-types', \App\Http\Controllers\TrainingTypeController::class);
    Route::resource('plans', \App\Http\Controllers\PlanController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
