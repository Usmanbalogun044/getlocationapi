<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ipcontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::match(['get','post'],'/collect-ip',[Ipcontroller::class,'collectip'])->name('');
