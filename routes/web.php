<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)
    ->middleware(['auth', 'verified'])
    ->name('home');

// Authentication Routes

Route::get('login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('register', Register::class)
    ->middleware('guest')
    ->name('register');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// email verification view
Route::get('/email/verify', VerifyEmail::class)
    ->middleware('auth', 'unverified')
    ->name('verification.notice');

// email verification confirm
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// forgot-password
Route::get('/forgot-password', ForgotPassword::class)->middleware('guest')->name('password.request');

// reset password
Route::get('/reset-password/{token}', ResetPassword::class)->middleware('guest')->name('password.reset');
