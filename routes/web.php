<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ResponseController;

Route::get('auth/register', [AuthController::class,
        'showRegisterForm'])->name('register');
        
Route::post('auth/postRegister', [AuthController::class,
    'register'])->name('postRegister');

Route::get('auth/login', [AuthController::class,
    'showLoginForm'])->name('login');

Route::post('auth/postLogin', [AuthController::class,
    'login'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('tickets', TicketController::class);

    Route::post('tickets/{ticket}/responses',
    [ResponseController::class, 'store'])->name('responses.store');

    Route::middleware(['CekRole:admin'])->group(function () {
        Route::post('tickets/{ticket}/update-status',
        [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    });
});
