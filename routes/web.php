<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login_check', [LoginController::class, 'login_check'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('/dashboard/learner', function () {
    return view('learner.dashboard');
})->name('learner.dashboard');

Route::resource('user', UserController::class);
route::post('/store_learner', [UserController::class, 'store_learner'])->name('user.store_learner');

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/create', [LoginController::class, 'create_changepassword'])->name('changepassword.create');
Route::post('/change_password', [LoginController::class, 'changePassword'])->name('changePassword.update');

Route::get('/forgot_password', [ForgotPasswordController::class, 'create'])->name('forgot_password');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');