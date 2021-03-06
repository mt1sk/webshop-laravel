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
        $view = view('admin.home');
        $view->with('menu_section');
        $view->with('menu_item');
        return $view;
    })->name('admin.home');

    Route::get('categories/list', ['as'=>'categories.list', 'uses'=>'Admin\CategoryController']);
    Route::resource('categories', 'Admin\CategoryController', ['except'=>['index', 'show']]);

    Route::get('brands/list')->name('brands.list')->uses('Admin\BrandController');
    Route::resource('brands', 'Admin\BrandController', ['except'=>['index', 'show']]);

    Route::get('products/list', ['as'=>'products.list', 'uses'=>'Admin\ProductController']);
    Route::resource('products', 'Admin\ProductController', ['except'=>['index', 'show']]);

    Route::get('managers/list', ['as'=>'managers.list', 'uses'=>'Admin\ManagerController']);
    Route::resource('managers', 'Admin\ManagerController', ['except'=>['index', 'show']]);

    Route::get('coupons/list', ['as'=>'coupons.list', 'uses'=>'Admin\CouponController']);
    Route::resource('coupons', 'Admin\CouponController', ['except'=>['index', 'show']]);

    Route::get('payments/list', ['as'=>'payments.list', 'uses'=>'Admin\PaymentController']);
    Route::resource('payments', 'Admin\PaymentController', ['except'=>['index', 'show']]);

    Route::get('deliveries/list', ['as'=>'deliveries.list', 'uses'=>'Admin\DeliveryController']);
    Route::resource('deliveries', 'Admin\DeliveryController', ['except'=>['index', 'show']]);
});

Auth::routes(['verify' => true]);
Route::get('/user', 'UserController@index')->name('user_home');
Route::post('/user', 'UserController@update');

Route::get('/', ['as'=>'main_page', 'uses'=>'IndexController']);
Route::get('/categories/{url}', 'CategoryController@productsList')->name('category_page');
Route::get('/brands', 'BrandController@brandsList')->name('brands_list');
Route::get('/brands/{url}', 'BrandController@productsList')->name('brand_page');
Route::get('/product/{url}', 'ProductController@productItem')->name('product_page');

Route::post('/cart_ajax', 'Ajax\CartController')->name('cart_ajax');
Route::get('/cart', 'CartController')->name('cart_page');
Route::post('/cart', 'CartController@checkout');
Route::get('/order/{url}', 'OrderController@show')->name('order_page');
Route::post('/order/payment_callback', 'PaymentController@callback')->name('payment_callback');

Route::post('/wishlist_ajax', 'Ajax\WishlistController')->name('wishlist_ajax');
Route::get('/wishlist', 'WishlistController')->name('wishlist_page');

Route::get('/delivery/get_details', 'Ajax\DeliveryController@getDetails')->name('get_delivery_info');
