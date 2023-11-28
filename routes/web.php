<?php

use Illuminate\Support\Facades\Route;



//Route::get('/', function () {
//    return view('front.homepage');
//});

/*
|--------------------------------------------------------------------------
| Backend routes
|--------------------------------------------------------------------------
*/
Route::get('admin/panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
Route::get('admin/login', 'App\Http\Controllers\Back\Auth@login')->name('login');
Route::post('admin/login', 'App\Http\Controllers\Back\Auth@loginPost')->name('login.post');
Route::get('admin/logout','App\Http\Controllers\Back\Auth@logout')->name('logout');


/*
|--------------------------------------------------------------------------
| Front routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/articles', 'App\Http\Controllers\Front\Homepage@index');
Route::get('/contact','App\Http\Controllers\Front\Homepage@contact')->name('contact'); // Fixed defined URLs should be placed on top
Route::post('/contact','App\Http\Controllers\Front\Homepage@contactPost')->name('contact.post');
Route::get('/category/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{page}','App\Http\Controllers\Front\Homepage@page')->name('page');

