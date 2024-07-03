<?php

use App\Http\Controllers\TodoControl;
use App\Http\Controllers\UserControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login and Regsiter Method
Route::post('/register',[UserControl::class,'registrasi']);
Route::post('/masuk',[UserControl::class,'login']);
Route::post('/keluar',[UserControl::class,'logout'])->middleware('auth:sanctum');
Route::get('/user',[UserControl::class,'getUser'])->middleware('auth:sanctum');

// Todo Method
Route::get('/todo',[TodoControl::class,'index'])->middleware('auth:sanctum');
Route::post('/todo',[TodoControl::class,'store'])->middleware('auth:sanctum');
Route::delete('/todo/{id}',[TodoControl::class,'destroy'])->middleware('auth:sanctum');
Route::put('/todo/{id}',[TodoControl::class,'update'])->middleware('auth:sanctum');