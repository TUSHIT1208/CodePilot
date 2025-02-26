<?php

use App\Http\Controllers\TestOptionController;
use App\Http\Controllers\TestQestionController;
use App\Http\Controllers\TestQuestionController;
use App\Models\TestOption;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LearningPathController;
use App\Http\Controllers\LearnerProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SubCategoryController;



Route::get('/', function () {
    return view('frontside.about');
})->name('about');

Route::get('/blog', function () {
    return view('frontside.blog');
})->name('blog');

Route::get('/company', function () {
    return view('frontside.company');
})->name('company');

Route::get('/carrer', function () {
    return view('frontside.carrer');
})->name('carrer');

Route::get('/press', function () {
    return view('frontside.press');
})->name('press');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login_check', [LoginController::class, 'login_check'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/course', function () {
    return view('admin.course');
})->name('admin.course')->middleware('auth');

Route::get('/review', function () {
    return view('admin.review');
})->name('admin.review')->middleware('auth');

Route::get('/analyics', function () {
    return view('admin.analycis');
})->name('admin.analyics')->middleware('auth');

Route::get('/certificate', function () {
    return view('admin.certificate');
})->name('admin.certificate')->middleware('auth');

Route::get('/earning', function () {
    return view('admin.earning');
})->name('admin.earning')->middleware('auth');

Route::get('/payout', function () {
    return view('admin.payout');
})->name('admin.payout')->middleware('auth');

Route::get('/statement', function () {
    return view('admin.statement');
})->name('admin.statement')->middleware('auth');

Route::get('/feedback', function () {
    return view('admin.feedback');
})->name('admin.feedback');


Route::get('admin/saved/course', function () {
    return view('admin.saved_courses');
})->name('admin.saved.course')->middleware('auth');

Route::get('view/saved/course', function () {
    return view('admin.particular_course');
})->name('saved.course.view');

Route::get('admin/help', function () {
    return view('admin.help');
})->name('admin.help')->middleware('auth');

Route::get('/dashboard/learner', function () {
    return view('learner.dashboard');
})->name('learner.dashboard')->middleware('auth');

Route::resource('user', UserController::class);
route::get('user/{id}', [UserController::class, 'destroy']);
Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulk-delete');

route::get('user/{id}', [UserController::class, 'edit']);

Route::get('/instructor', [UserController::class, 'instructorList'])->name('instructorList')->middleware('auth');

Route::post('/admin/update-user-status', [UserController::class, 'updateUserStatus'])->name('update.user.status');


route::post('/store_learner', [UserController::class, 'store_learner'])->name('user.store_learner');

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/setting', [UserController::class, 'aboutabmin'])->name('setting')->middleware('auth');
Route::get('/learner/setting', [UserController::class, 'learner_setting'])->name('learner.setting');

Route::post('/upload-profile-image', [UserController::class, 'uploadImage'])->name('upload.profile.image');

Route::get('/learner/profile', [UserController::class, 'learner_show'])->name('user.learner.profile');

Route::get('/create', [LoginController::class, 'create_changepassword'])->name('changepassword.create');
Route::post('/change_password', [LoginController::class, 'changePassword'])->name('changePassword.update');

Route::get('/forgot_passwords', [ForgotPasswordController::class, 'create'])->name('forgot_password');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::resource('category', CategoryController::class)->middleware('auth');
Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
Route::post('/categories/update-status', action: [CategoryController::class, 'updateStatus'])->name('categories.update-status');

Route::resource('subcategory', SubCategoryController::class)->middleware('auth');
Route::post('/sub_categories/bulk-delete', [SubCategoryController::class, 'bulkDelete'])->name('subcategories.bulk-delete');
Route::post('/subcategory/update-subcategory-status', [SubCategoryController::class, 'updateSubCategoryStatus'])->name('update.subcategory.status');

Route::resource('faq', FaqController::class)->middleware('auth');
Route::post('/faqs/bulk-delete', [FaqController::class, 'bulkDelete'])->name('faq.bulk-delete');

Route::resource('learningpath', LearningPathController::class)->middleware('auth');
Route::post('/learningpath/bulk-delete', [LearningPathController::class, 'bulkDelete'])->name('learningpath.bulk-delete');


Route::resource('course', CourseController::class);

Route::resource('test', TestController::class);


route::resource('testquestion', TestQuestionController::class);

route::resource('testoption', TestOptionController::class);

Route::resource('video', VideoController::class);

// Add this route to handle the AJAX request for subcategories
Route::get('/admin/course/subcategories', [CourseController::class, 'getSubCategories']);

Route::get('/course/test', function () {
    return view('admin.course.test');
})->name('course.test')->middleware('auth');

Route::get('/course/basic-information', function () {
    return view('admin.course.basic_information');
})->name('course.basic-information');

Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit')->middleware('auth');

route::post('course/price/{course}', [CourseController::class, 'price'])->name('course.price')->middleware('auth');