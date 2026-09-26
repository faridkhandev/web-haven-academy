<?php

use App\\Http\\Controllers\\StudentLoginController;
use App\\Http\\Controllers\\StudentWelcomeController;\nuse App\\Http\\Controllers\\StudentDashboardController;\nuse App\\Http\\Controllers\\StudentProfileController;
use Illuminate\\Support\\Facades\\Route;

Route::get('/studentlogin', [StudentLoginController::class, 'show'])->name('student.login');
Route::post('/studentlogin', [StudentLoginController::class, 'login'])->name('student.login.submit');

Route::middleware('web')->group(function () {
    Route::get('/student/welcome', [StudentWelcomeController::class, 'index'])->name('student.welcome');\n    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');\n    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');\n    Route::post('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::view('/block', 'student.block')->name('student.block');
});
