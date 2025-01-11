<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/',[UserController::class,'create'])->name('login');
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/password_view', [UserController::class, 'create_changepassword']);

Route::post('/change_password', [UserController::class, 'changePassword'])->name('changePassword');

Route::get('/forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


