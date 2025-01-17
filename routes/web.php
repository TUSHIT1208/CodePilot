<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/login',[LoginController::class,'create'])->name('login');
Route::post('/login_check',[LoginController::class,'login_check'])->name('login_check');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/create', [LoginController::class, 'create_changepassword'])->name('changepassword.create');

Route::post('/change_password', [LoginController::class, 'changePassword'])->name('changePassword.update');

Route::get('/forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::resource('user', UserController::class);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

route::post('/store_learner',[UserController::class,'store_learner'])->name('user.store_learner');

Auth::routes(['verify' => true]);
Auth::routes();
Route::get('password/reset', [ForgotPasswordController::class, 'create']);
// route::get('/forget_password',[ForgotPasswordController::class,'create'])->name('forget_password');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
