<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('front.homepage');
//});

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/articles', 'App\Http\Controllers\Front\Homepage@index');
Route::get('/category/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{page}','App\Http\Controllers\Front\Homepage@page')->name('page');
