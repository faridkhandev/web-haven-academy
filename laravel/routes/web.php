<?php

use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentWelcomeController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentCourseController;
use Illuminate\Support\Facades\Route;

Route::get('/studentlogin', [StudentLoginController::class, 'show'])->name('student.login');
Route::post('/studentlogin', [StudentLoginController::class, 'login'])->name('student.login.submit');

Route::middleware('web')->group(function () {
    Route::get('/student/welcome', [StudentWelcomeController::class, 'index'])->name('student.welcome');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::post('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::get('/student/course', [StudentCourseController::class, 'index'])->name('student.course');
    Route::get('/student/course/view', [StudentCourseController::class, 'view'])->name('student.course.view');
    Route::get('/student/course/sessionview', [StudentCourseController::class, 'sessionView'])->name('student.course.session');
    Route::post('/student/course/addrequest', [StudentCourseController::class, 'addRequest'])->name('student.course.addrequest');
    Route::post('/student/course/uploadrequest', [StudentCourseController::class, 'uploadRequest'])->name('student.course.uploadrequest');
    Route::view('/block', 'student.block')->name('student.block');
});
