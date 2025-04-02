<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('employee')->middleware('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('public.pages.dashboard');
    })->name('dashboard');

    Route::resource('profile', UserController::class);
    Route::resource('leaves', LeaveController::class);
    Route::resource('attendances', AttendanceController::class);
});
