<?php

use App\Http\Controllers\Category\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/course', function () {
    return view('admin.create_new_course');
})->name('admin.create.course');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login_check', [LoginController::class, 'login_check'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');


Route::get('/dashboard/learner', function () {
    return view('learner.dashboard');
})->name('learner.dashboard')->middleware('auth');

Route::resource('user', UserController::class);
route::get('user/{id}', [UserController::class, 'destroy']);
Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulk-delete');

route::get('user/{id}', [UserController::class, 'edit']);

Route::get('/instructorList', [UserController::class, 'instructorList'])->name('instructorList');

Route::post('/admin/update-user-status', [UserController::class, 'updateUserStatus'])->name('update.user.status');


route::post('/store_learner', [UserController::class, 'store_learner'])->name('user.store_learner');

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/setting', [UserController::class,'aboutabmin'])->name('setting');
Route::get('/learner/setting', [UserController::class,'learner_setting'])->name('learner.setting');

Route::post('/upload-profile-image', [UserController::class, 'uploadImage'])->name('upload.profile.image');

Route::get('/learner/profile', [UserController::class, 'learner_show'])->name('user.learner.profile');

Route::get('/create', [LoginController::class, 'create_changepassword'])->name('changepassword.create');
Route::post('/change_password', [LoginController::class, 'changePassword'])->name('changePassword.update');

Route::get('/forgot_password', [ForgotPasswordController::class, 'create'])->name('forgot_password');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::resource('category', CategoryController::class);
Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
Route::post('/category/update-category-status', [CategoryController::class, 'updateCategoryStatus'])->name('update.category.status');


Route::resource('sub_category', SubCategoryController::class);
Route::post('/sub_categories/bulk-delete', [SubCategoryController::class, 'bulkDelete'])->name('subcategories.bulk-delete');
Route::post('/subcategory/update-subcategory-status', [SubCategoryController::class, 'updateSubCategoryStatus'])->name('update.subcategory.status');

