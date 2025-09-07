<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {  return view('admin/login'); })->name('admin-home');


Route::get('/dashboard', function () {  $type="admin"; $leads=[]; return view('admin/dashboard',compact('type','leads')); })->name('admin-dashbaord');


Route::get('/seminar', function () {  $type="admin"; $seminardates=[]; return view('admin/seminar',compact('type','seminardates')); })->name('admin-seminar');