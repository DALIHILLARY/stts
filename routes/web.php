<?php

use App\Admin\Controllers\FormSr4Controller;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PrintController2;
use App\Http\Middleware\Authenticate;
use App\Admin\Controllers\Charts\QualityAssurance\BarGraphTotalsController;
use App\Admin\Controllers\Charts\QualityAssurance\PieChartTotalsController;
use App\Admin\Controllers\FormSr6CropQueryController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/dd', [BarGraphTotalsController::class, 'index']);
Route::get('/dddd', [PieChartTotalsController::class, 'index']);

Route::get('/', [MainController::class, 'index']);

// Route::get('/test', [MainController::class, function (){
//     dd("Simple test");
// }]);

Route::get('/about', [MainController::class, 'about']);
Route::get('/import', [MainController::class, 'import']);
// Route::get('/admin/1e24tt00X24/crops', [FormSr6CropQueryController::class, 'import']);

Route::get('/register', [MainController::class, 'register_get'])->name("register");
Route::match(['get', 'post'], '/login', [MainController::class, 'login'])->name("login");
Route::post('/register', [MainController::class, 'register'])->name("register_post");
// Route::post('/register', [AuthController::class, 'create'])->name("register_post");

Route::get('/dashboard', [Dashboard::class, 'index'])->name("dashboard")->middleware(Authenticate::class);
Route::get('/complete-profile-request', [Dashboard::class, 'complete_profile_request'])->name("complete_profile_request")->middleware(Authenticate::class);

Route::get('/membership', [Dashboard::class, 'membership'])->name("membership")->middleware(Authenticate::class);
Route::get('/favourites', [Dashboard::class, 'favourites'])->name("favourites");

Route::match(['get', 'post'], '/post-ad', [Dashboard::class, 'postAdCategpryPick'])->name("post-ad")->middleware(Authenticate::class);
Route::get('/post-ad/{id}', [Dashboard::class, 'postAd'])->middleware(Authenticate::class);

Route::match(['get', 'post'], '/profile-edit/{id}', [Dashboard::class, 'profileEdit'])->name("profile-edit");

Route::get('/profile', [Dashboard::class, 'profile'])->middleware(Authenticate::class);
Route::get('/logout', [Dashboard::class, 'logout'])->middleware(Authenticate::class);

Route::match(['get', 'post'], '/messages/', [Dashboard::class, 'messages'])->name("messages")->middleware(Authenticate::class);
Route::match(['get', 'post'], '/messages/{thread}', [Dashboard::class, 'messages'])->name("messages_two")->middleware(Authenticate::class);

Route::match(['get', 'post'], '/print', [PrintController2::class, 'index']);

/*Route::get('/', function () {
    return view('welcome');
});*/

//always the last.
Route::match(['get', 'post'], '/{id}', [MainController::class, 'slugSwitcher']);


// send emails
Route::get('/notify', [FormSr4Controller::class, 'notify'])->name("notify")->middleware(Authenticate::class);


// Email Verification Routes
Route::get('/email/verify', 'EmailVerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'EmailVerificationController@verify')->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', 'EmailVerificationController@resend')->name('verification.resend');
