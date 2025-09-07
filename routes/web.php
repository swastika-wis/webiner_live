<?php 


use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('index');})->name('index');
Route::post('/login',[LoginController::class,"login"])->name('login');
Route::get('/logout',[LoginController::class,"logout"])->name('logout');

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

});