<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstagramAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/accounts', [InstagramAccountController::class, 'index'])->name('accounts.index');
    Route::post('/accounts', [InstagramAccountController::class, 'store'])->name('accounts.store');
    Route::post('/accounts/{account}/toggle-status', [InstagramAccountController::class, 'toggleStatus'])->name('accounts.toggle-status');
    Route::delete('/accounts/{account}', [InstagramAccountController::class, 'destroy'])->name('accounts.destroy');
});

use App\Http\Controllers\MetaAuthController;

Route::get('/oauth/redirect', [MetaAuthController::class, 'redirectToMeta'])->name('meta.redirect');
Route::get('/oauth/callback', [MetaAuthController::class, 'handleMetaCallback'])->name('meta.callback');