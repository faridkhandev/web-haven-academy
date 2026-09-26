<?php

use App\\Http\\Controllers\\StudentLoginController;
use App\\Http\\Controllers\\StudentWelcomeController;
use Illuminate\\Support\\Facades\\Route;

Route::get('/studentlogin', [StudentLoginController::class, 'show'])->name('student.login');
Route::post('/studentlogin', [StudentLoginController::class, 'login'])->name('student.login.submit');

Route::middleware('web')->group(function () {
    Route::get('/student/welcome', [StudentWelcomeController::class, 'index'])->name('student.welcome');
    Route::view('/block', 'student.block')->name('student.block');
});
