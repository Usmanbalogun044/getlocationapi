<?php

use App\Http\Controllers\Ipcontroller;
use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::match(['get','post'],'/collect-ip',[Ipcontroller::class,'collectip'])->name('');
// Route::post('/collect-ip',[Ipcontroller::class,'collectip'])->name('');
