<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'gym_subscription'])->group(function () {
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

// Subscription Expired Route
Route::get('/subscription-expired', function () {
    return view('subscription_expired');
})->name('subscription.expired');

// Super Admin Routes
Route::middleware(['auth', 'super_admin'])->prefix('super-admin')->name('super_admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('dashboard');

    // Gyms Management
    Route::get('/gyms', [App\Http\Controllers\SuperAdminController::class, 'indexGyms'])->name('gyms.index');
    Route::get('/gyms/create', [App\Http\Controllers\SuperAdminController::class, 'createGym'])->name('gyms.create');
    Route::post('/gyms', [App\Http\Controllers\SuperAdminController::class, 'storeGym'])->name('gyms.store');
    Route::get('/gyms/{gym}', [App\Http\Controllers\SuperAdminController::class, 'showGymDetails'])->name('gyms.show');
    Route::get('/gyms/{gym}/edit', [App\Http\Controllers\SuperAdminController::class, 'editGym'])->name('gyms.edit');
    Route::put('/gyms/{gym}', [App\Http\Controllers\SuperAdminController::class, 'updateGym'])->name('gyms.update');
    Route::patch('/gyms/{gym}/toggle', [App\Http\Controllers\SuperAdminController::class, 'toggleGymStatus'])->name('gyms.toggle');
    Route::patch('/gyms/{gym}/extend', [App\Http\Controllers\SuperAdminController::class, 'extendSubscription'])->name('gyms.extend');
    Route::delete('/gyms/{gym}', [App\Http\Controllers\SuperAdminController::class, 'destroyGym'])->name('gyms.destroy');

    // Users Management
    Route::get('/users', [App\Http\Controllers\SuperAdminController::class, 'indexUsers'])->name('users.index');

    // Reports
    Route::get('/reports', [App\Http\Controllers\SuperAdminController::class, 'indexReports'])->name('reports.index');
});

require __DIR__.'/auth.php';
