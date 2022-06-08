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



Route::group(['prefix' => 'admin'], function() {

    Route::get('/','Admin\HomeCtrl@index')->name('admin_home');
    Route::get('/maintainance/mode', 'Admin\Live\LiveController@index')->name('maintainance');
    Route::get('live', 'Admin\Live\LiveController@activate');
    Route::get('activities','Admin\Activity\ActivityController@index');
    Route::get('reports','Admin\Account\AccountsController@index');
    Route::get('account/filter','Admin\Account\AccountsController@index')->name('filter_sales');
    Route::get('customers',  'Admin\Users\UsersController@customers')->name('customers');
    Route::resource('permissions','Admin\Permission\PermissionsController',['names'=>'permissions']);


    Route::resource('users',  'Admin\Users\UsersController',['names'=>'admin.users']);

    Route::resource('banners', 'Admin\Design\BannersController',['names' =>'banners']);
    Route::resource('pages','Information\InformationController',['name' => 'pages']);



    Route::resource('shipping','Admin\Shipping\ShippingController',['names'=>'shipping']);
    Route::resource('location','Admin\Location\LocationController',['names'=>'location']);
    Route::resource('attributes','Admin\Attributes\AttributesController',['names'=>'attributes']);
    Route::resource('payments','Admin\Payments\PaymentController',['name'=>'payments']);
    Route::resource('rates','Admin\CurrencyRates\CurrencyRatesController',['name'=>'rates']);
    Route::resource('vouchers','Admin\Vouchers\VouchersController',['names'=>'vouchers']);
    Route::resource('products','Admin\Product\ProductController',['names' => 'products']);
    Route::resource('category','Admin\Category\CategoryController',['names'=>'category']);
    Route::post('category/delete/image','Admin\Category\CategoryController@undo');
    Route::resource('reviews',  'Admin\Reviews\ReviewsController',['names' => 'reviews']);
    Route::resource('orders','Admin\Orders\OrdersController',['names' => 'admin.orders']);
    Route::resource('brands', 'Admin\Brand\BrandsController',['names' =>'brands']);


});


Auth::routes();

Route::get('/',       [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plans',      [App\Http\Controllers\Plans\PlansController::class, 'index'])->name('plans');
Route::get('/subscribe',  [App\Http\Controllers\Subscribe\SubscribeController::class, 'index'])->name('subscribe');
Route::get('/checkout',   [App\Http\Controllers\Checkout\CheckoutController::class, 'index'])->name('checkout');
Route::get('/buy-now-pay-later',   [App\Http\Controllers\BuyNowPayLater\BuyNowPayLaterController::class, 'index'])->name('buy');

