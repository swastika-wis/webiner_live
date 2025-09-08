<?php 


use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\WebvendorController;
use Illuminate\Support\Facades\Route;


// Admin or vendor
Route::get('/', function () { return view('index');})->name('index');
Route::post('/login',[LoginController::class,"login"])->name('login');
Route::get('/logout',[LoginController::class,"logout"])->name('logout');


// Participent
Route::get('/user-login',[WebUserController::class,"user_login"])->name('user-login');
Route::post('/user-validate',[WebUserController::class,"user_validate"])->name('user-validate');


// Participent
Route::get('/vendor-login/{vendor_id}',[WebvendorController::class,"vendor_login"])->name('vendor-login');
Route::post('/vendor-validate',[WebvendorController::class,"vendor_validate"])->name('vendor-validate');



Route::middleware(['webuserGroup'])->group(function () {
    // auth checking
    Route::get('/dashboard',[LoginController::class,"dashboard"])->name('dashboard');

    /////// Vendor
    Route::get('/vendors',[VendorController::class,"vendor"])->name('vendor');
    Route::post('/vendors-store',[VendorController::class,"vendorStore"])->name('vendor.store');

    
    /////// zoom meetings
    Route::get('/meetings/{type}',[MeetingController::class,"index"])->name('meeting');
    Route::get('/create-meeting', [MeetingController::class, 'create'])->name('create-meeting');
    Route::post('/store-meeting', [MeetingController::class, 'store'])->name('store-meeting');


    // Register user for a meeting
    Route::get('/register-user/{meeting_id}',[MeetingController::class,"register_user"])->name('register-user');
    Route::post('store-participent',[MeetingController::class,"store_participent"])->name('store-participent');

});


Route::middleware(['participateGroup'])->group(function () {
    Route::get('/user-dashboard',[WebUserController::class,"dashboard"])->name('user-dashboard');
});


Route::middleware(['vendorGroup'])->group(function () {
    Route::get('/vendor-dashboard',[WebvendorController::class,"dashboard"])->name('vendor-dashboard');
});
