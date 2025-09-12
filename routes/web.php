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
Route::get('/host-logout',[LoginController::class,"vendor_logout"])->name('host-logout');
Route::get('/participent-logout',[LoginController::class,"participent_logout"])->name('participent-logout');


// Participent
Route::get('/user-login',[WebUserController::class,"user_login"])->name('user-login');
Route::post('/user-validate',[WebUserController::class,"user_validate"])->name('user-validate');
Route::get('/register-user/{meeting_id}',[MeetingController::class,"register_user"])->name('register-user');
Route::post('store-participent',[MeetingController::class,"store_participent"])->name('store-participent');


// Vendor
Route::get('/vendor-login/{vendor_id}',[WebvendorController::class,"vendor_login"])->name('vendor-login');
Route::post('/vendor-validate',[WebvendorController::class,"vendor_validate"])->name('vendor-validate');


/////// show participant list
Route::post('/get-participant',[MeetingController::class,"participant_list"])->name('partcipant-list');

Route::middleware(['webuserGroup'])->group(function () {
    
    Route::get('/dashboard',[LoginController::class,"dashboard"])->name('dashboard');

    /////// Vendor
    Route::get('/vendors',[VendorController::class,"vendor"])->name('vendor');
    Route::post('/vendors-store',[VendorController::class,"vendorStore"])->name('vendor.store');

    
    /////// zoom meetings
    Route::get('/meetings/{type}',[MeetingController::class,"index"])->name('meeting');
    Route::get('/create-meeting', [MeetingController::class, 'create'])->name('create-meeting');
    Route::post('/store-meeting', [MeetingController::class, 'store'])->name('store-meeting');

    Route::get('update-participant-status/{status}/{id}',[WebUserController::class,"update_participant_status"])->name('update-participant-status');
});


Route::middleware(['participateGroup'])->group(function () {
    Route::get('/user-dashboard',[WebUserController::class,"dashboard"])->name('user-dashboard');
    Route::get('join-meeting/{meeting_id}',[WebUserController::class,"join_meeting"])->name('join-meeting');
    Route::post('/user-poll-submission',[WebUserController::class,"user_poll_submission"])->name('user-poll-submission');
    Route::get('/poll-list',[WebUserController::class,"poll_list"])->name('poll.list');

});



Route::middleware(['vendorGroup'])->group(function () {
    Route::get('/vendor-dashboard',[WebvendorController::class,"dashboard"])->name('vendor-dashboard');
    Route::post('/vendor-poll-submission',[WebvendorController::class,"vendor_poll_submission"])->name('vendor-poll-submission');
    Route::get('/vendor-poll-list/{meeting_number}',[WebvendorController::class,"vendor_poll_list"])->name('vendor-poll-list');
    
});
