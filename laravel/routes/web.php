<?php

use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentWelcomeController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/studentlogin', [StudentLoginController::class, 'show'])->name('student.login');
Route::post('/studentlogin', [StudentLoginController::class, 'login'])->name('student.login.submit');

Route::middleware('web')->group(function () {
    Route::get('/student/welcome', [StudentWelcomeController::class, 'index'])->name('student.welcome');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::post('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::view('/block', 'student.block')->name('student.block');
});
