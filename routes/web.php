<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserVideoTrackerController;
use App\Models\certificate;
use App\Models\faq;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\purchesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TestOptionController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\LearningPathController;
use App\Http\Controllers\TestQuestionController;
use App\Http\Controllers\CourseAttachmentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PaymentTransactionController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/about', [HomeController::class, 'about'])->name('about');

// Route::get('/courses', function () {
//     return view('front.course');
// })->name('course');

Route::get('/courses', [HomeController::class, 'course'])->name('course');

// routes/web.php
Route::post('/courses/add-to-home', [CourseController::class, 'addToHome'])->name('courses.addToHome');


Route::get('/list/instructor', function () {
    return view('front.list_trainer');
})->name('listInstructor');



Route::get('contact', function () {
    return view('front.contact');
})->name('contact');



Route::get('Faq', function () {
    $faqs = faq::all();
    return view('front.faq', compact('faqs'));
})->name('faq.display');



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

Route::get('instructor/help', function () {
    return view('instructor.help');
})->name('instructor.help')->middleware('auth');

Route::get('/dashboard/learner', function () {
    return view('learner.dashboard');
})->name('learner.dashboard')->middleware('auth');

Route::get('/dashboard/instructor', function () {
    return view('instructor.dashboard');
})->name('instructor.dashboard')->middleware('auth');

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
Route::get('/instructor/setting', [UserController::class, 'instructor_setting'])->name('instructor.setting');

Route::post('/upload-profile-image', [UserController::class, 'uploadImage'])->name('upload.profile.image');



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

Route::resource('faq', controller: FaqController::class)->middleware('auth');
//Route::get('display/faqs', [FaqController::class, 'display'])->name('faq.display');
Route::post('/faqs/bulk-delete', [FaqController::class, 'bulkDelete'])->name('faq.bulk-delete');

Route::resource('learningpath', LearningPathController::class)->middleware('auth');
Route::post('/learningpath/bulk-delete', [LearningPathController::class, 'bulkDelete'])->name('learningpath.bulk-delete');


Route::resource('course', CourseController::class);
Route::patch('/courses/toggle-status/{course}', [CourseController::class, 'toggleStatus'])->name('courses.toggle');


Route::resource('test', TestController::class);
Route::get('/test/{quiz}', [TestController::class, 'show'])->name('test.show');
Route::put('/test/{quiz}', [TestController::class, 'update'])->name('test.update');



route::resource('testquestion', TestQuestionController::class);

route::resource('testoption', TestOptionController::class);

Route::resource('courseAttachment', CourseAttachmentController::class);
Route::post('/video/progress/track', [UserVideoTrackerController::class, 'track'])->name('video.progress.track');

Route::get('/admin/course/subcategories', [CourseController::class, 'getSubCategories']);
Route::get('/code-debugger/{id}/{video_id}', [CourseAttachmentController::class, 'debugger_code'])->name('codeDebugger');

Route::get('/course/test', function () {
    return view('admin.course.test');
})->name('course.test')->middleware('auth');

Route::get('/course/basic-information', function () {
    return view('admin.course.basic_information');
})->name('course.basic-information');


Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit')->middleware('auth');

route::post('course/price/{course}', [CourseController::class, 'price'])->name('course.price')->middleware('auth');

route::get('course/purches/{id}', [purchesController::class, 'purches_index'])->name('course.purches')->middleware('auth');

Route::get('/learner/profile/{id}', [UserController::class, 'learner_show'])->name('user.learner_show')->middleware('auth');

Route::get('/instructor/profile/{id}', [UserController::class, 'instructor_show'])->name('user.instructor_show')->middleware('auth');

Route::post('/account/close', [LoginController::class, 'closeAccount'])->name('account.close');

Route::get('/cart', function () {
    return view('learner.cart.shopping_cart');
})->name('cart')->middleware('auth');

Route::get('/saved-course', function () {
    return view('learner.saved_course.saved_courses');
    // return view('learner.checkout.checkout');
})->name('saved.course')->middleware('auth');

route::resource('cart', CartController::class)->middleware('auth');
route::resource('wishlist', WishlistController::class)->middleware('auth');
route::resource('order', OrderController::class)->middleware('auth');

Route::get('/counts', [CartController::class, 'getCounts'])->name('cart.counts')->middleware();

Route::get('/payment/callback', [OrderController::class, 'paymentCallback']);
Route::get('/payment-success', function () {
    return "Payment successful!";
});

Route::get('/payment-failed', function () {
    return "Payment failed!";
});
Route::post('/razorpay/success', [OrderController::class, 'handlePaymentSuccess']);

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::get('/certificate/center', function () {
    return view('learner.course.certificate.certificat_Center');
})->name('certificate.center')->middleware('auth');

Route::get('/certificate/fillout', function () {
    return view('learner.course.certificate.fill');
})->name('learner.fill.certificate')->middleware('auth');

Route::get('/test/certification', function () {
    return view('learner.course.certificate.test');
})->name('learner.certification.exam')->middleware('auth');


Route::resource('certificate', CertificateController::class);

Route::get('/genarate', [CertificateController::class, 'index']);
Route::get('/cirty', [CertificateController::class, 'cirty']);

route::get('/learning-path', [LearningPathController::class, 'learningpath_learner'])->name('learning.path')->middleware('auth');

Route::resource('contactus', ContactusController::class);
Route::delete('/contactus/{id}', [ContactusController::class, 'destroy'])->name('contactus.destroy');
Route::post('/contactus/delete-multiple', [ContactusController::class, 'deleteMultiple'])->name('contactus.deleteMultiple');

Route::get('/courses-by-category', [CourseController::class, 'getCoursesByCategory'])->name('course.byCategory')->middleware('auth');

route::resource('transactions', PaymentTransactionController::class)->middleware('auth');

Route::get('/payment-history', [PaymentTransactionController::class, 'learner_payment_history'])->name('payment.history')->middleware('auth');

Route::get('/invoice/view/{id}', [PaymentTransactionController::class, 'viewInvoice'])->name('invoice.view')->middleware('auth');
Route::get('/invoice/download/{id}', [PaymentTransactionController::class, 'downloadInvoice'])->name('invoice.download')->middleware('auth');

Route::post('/course/publish', [CourseController::class, 'publishCourse'])->name('course.publish');

Route::post('/test/{testId}/submit', [TestResultController::class, 'submitTest'])->name('test.submit');

Route::get('/total/learners', [DashboardController::class, 'learner'])->name('totalLearners');