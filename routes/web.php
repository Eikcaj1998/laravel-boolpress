<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
    Route::get('/','HomeController@index')->name('home');
    
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::patch('/posts{post}/toggle','PostController@toggle')->name('posts.toggle');
    Route::resource('posts','PostController');
    Route::resource('categories','CategoryController');
    

    Route::get('/{any}',function (){
        abort('404');
    })->where('any','.*');
});
Route::get('/{any?}',function (){
    return view('guest.home');
})->where('any','.*');
