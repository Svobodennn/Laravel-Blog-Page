<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\Auth;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Article;
use App\Http\Controllers\Back\Category;


//Route::get('/', function () {
//    return view('front.homepage');
//});

/*
|--------------------------------------------------------------------------
| Backend routes
|--------------------------------------------------------------------------
*/



Route::prefix('admin')->group(function (){
//    $back = "App\Http\Controllers\Back";
    // redirect to dashboard if user is logged in
    Route::middleware(['isLogin'])->group(function (){
//        global $back;
        Route::get('/login',[Auth::class,'login'])->name('login');
        Route::post('/login',[Auth::class,'loginPost'])->name('login.post');
//        Route::get('/login', $back .'\Auth@login')->name('login');
//        Route::post('/login', $back . '\Auth@loginPost')->name('login.post');
    });

    Route::middleware(['isAdmin'])->group(function (){
//        global $back;
        // redirect to login page if user didn't log in
        Route::get('/panel', [Dashboard::class, 'index'])->name('dashboard');

        // all the routes and functions defined for article
        Route::get('articles/trashed',[Article::class, 'trashed'])->name('trashed.articles');
        Route::get('articles/trashed/{id}',[Article::class, 'recover'])->name('recover.article');
        Route::resource('articles',Article::class);


        // all the routes and functions defined for category
        Route::get('categories/trashed',[Category::class, 'trashed'])->name('trashed.categories');
        Route::get('categories/trashed/{id}',[Category::class, 'recover'])->name('recover.category');
        Route::resource('categories',Category::class);

        Route::get('/logout',[Auth::class, 'logout'])->name('logout');
        Route::get('/switcharticle',[Article::class,'switch'])->name('switch.article');
        Route::get('/switchcategory',[Category::class,'switch'])->name('switch.category');
        Route::get('/deletearticle/{id}',[Article::class, 'delete'])->name('delete.article');
        Route::get('/harddeletearticle/{id}',[Article::class, 'hardDelete'])->name('hard.delete.article');
        Route::get('/deletecategory/{id}',[Category::class, 'delete'])->name('delete.category');
        Route::get('/harddeletecategory/{id}',[Category::class, 'hardDelete'])->name('hard.delete.category');
//        Route::get('/panel', '\Dashboard@index')->name('dashboard');
//        Route::get('/logout', $back . '\Auth@logout')->name('logout');
    });
});


/*
|--------------------------------------------------------------------------
| Front routes
|--------------------------------------------------------------------------
*/

$front = "App\Http\Controllers\Front";
Route::get('/', $front . '\Homepage@index')->name('homepage');
Route::get('/articles', $front . '\Homepage@index');
Route::get('/contact', $front . '\Homepage@contact')->name('contact'); // Fixed defined URLs should be placed on top
Route::post('/contact', $front . '\Homepage@contactPost')->name('contact.post');
Route::get('/category/{category}', $front . '\Homepage@category')->name('category');
Route::get('/{category}/{slug}', $front . '\Homepage@single')->name('single');
Route::get('/{page}', $front . '\Homepage@page')->name('page');

