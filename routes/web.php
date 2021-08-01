<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


route::group(['middleware' => 'auth'], function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/images', 'App\Http\Controllers\ImageController@getImages')->name('images');
Route::get('/find', 'App\Http\Controllers\ImageController@find')->name('Find');
Route::get('/delete', 'App\Http\Controllers\ImageController@delete')->name('delete');

Route::post('/findFile', 'App\Http\Controllers\ImageController@findFile')->name('findFile');
    Route::post('/deleteFile', 'App\Http\Controllers\ImageController@deleteFile')->name('deleteFile');
    Route::post('/deleteByPath', 'App\Http\Controllers\ImageController@deleteByPath')->name('deleteByPath');

Route::post('/upload', 'App\Http\Controllers\ImageController@postUpload')->name('uploadfile');

    
});
