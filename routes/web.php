<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('administrator', 'Admin\LoginController@showLoginForm')->name('administrator.login');
Route::post('administrator', 'Admin\LoginController@login');
Route::get('administrator/logout', 'Admin\LoginController@logout')->name('administrator.logout');

Route::group(['prefix'=>'administrator', 'middleware'=>['auth:administrator']], function() {
    Route::get('home', function () {
        return view('admin.home');
    });

    Route::get('categories/list', ['as'=>'categories.list', 'uses'=>'Admin\CategoryController']);
    Route::resource('categories', 'Admin\CategoryController', ['except'=>['index', 'show']]);

    Route::get('brands/list')->name('brands.list')->uses('Admin\BrandController');
    Route::resource('brands', 'Admin\BrandController', ['except'=>['index', 'show']]);
});

Auth::routes(['verify' => true]);
