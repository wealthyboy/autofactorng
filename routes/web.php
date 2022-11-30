<?php

use App\Models\Order;
use Illuminate\Support\Facades\DB;
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



Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'Admin\HomeCtrl@index')->name('admin_home');
    Route::get('/maintainance/mode', 'Admin\Live\LiveController@index')->name('maintainance');
    Route::get('live', 'Admin\Live\LiveController@activate');
    Route::get('activities', 'Admin\Activity\ActivityController@index');
    Route::get('reports', 'Admin\Account\AccountsController@index');
    Route::get('account/filter', 'Admin\Account\AccountsController@index')->name('filter_sales');
    Route::resource('customers', 'Admin\Customers\CustomersController', ['name' => 'customers']);
    Route::get('orders/invoice/{id}', 'Admin\Orders\OrdersController@invoice')->name('order.invoice');
    Route::get('orders/dispatch/{id}', 'Admin\Orders\OrdersController@dispatchNote')->name('order.dispatch.note');
    Route::resource('location', 'Admin\Location\LocationController', ['names' => 'location']);
    Route::resource('engines', 'Admin\Engines\EnginesController', ['names' => 'engines']);


    //Route::post('register','Admin\Users\UsersController@create')->name('create.admin.users');

    Route::resource('permissions', 'Admin\Permission\PermissionsController', ['names' => 'permissions']);
    Route::post('upload/image', 'Admin\Image\ImagesController@store');
    Route::post('delete/image', 'Admin\Image\ImagesController@undo');
    Route::post('upload', 'Admin\Uploads\UploadsController@store');
    Route::get('delete/upload', 'Admin\Uploads\UploadsController@destroy');
    Route::resource('users',  'Admin\Users\UsersController', ['names' => 'admin.users']);

    Route::resource('banners', 'Admin\Design\BannersController', ['names' => 'banners']);
    Route::resource('pages', 'Admin\Information\InformationController', ['names' => 'pages']);
    Route::resource('settings', 'Admin\Settings\SettingsController', ['names' => 'settings']);

    Route::resource('shipping', 'Admin\Shipping\ShippingController', ['names' => 'shipping']);
    Route::resource('location', 'Admin\Location\LocationController', ['names' => 'location']);
    Route::resource('attributes', 'Admin\Attributes\AttributesController', ['names' => 'attributes']);
    Route::resource('payments', 'Admin\Payments\PaymentController', ['name' => 'payments']);
    Route::resource('rates', 'Admin\CurrencyRates\CurrencyRatesController', ['name' => 'rates']);
    Route::resource('vouchers', 'Admin\Vouchers\VouchersController', ['names' => 'vouchers']);
    Route::resource('products', 'Admin\Product\ProductController', ['names' => 'products']);
    Route::resource('category', 'Admin\Category\CategoryController', ['name' => 'category']);
    Route::post('category/delete/image', 'Admin\Category\CategoryController@undo');
    Route::resource('reviews',  'Admin\Reviews\ReviewsController', ['names' => 'reviews']);
    Route::resource('orders', 'Admin\Orders\OrdersController', ['names' => 'admin.orders']);
    Route::resource('brands', 'Admin\Brand\BrandsController', ['names' => 'brands']);
    Route::resource('promos', 'Admin\Promo\PromoController', ['names' => 'promos']);
    Route::get('promo-text/create/{id}', 'Admin\PromoText\PromoTextController@create')->name('create.promo.text');
    Route::get('promo-text/edit/{id}', 'Admin\PromoText\PromoTextController@edit')->name('edit_promo_text');
    Route::post('promo-text/edit/{id}', 'Admin\PromoText\PromoTextController@update');
    Route::post('promo-text/create/{id}', 'Admin\PromoText\PromoTextController@store');
    Route::get('promo-text/delete/{id}', 'Admin\PromoText\PromoTextController@destroy')->name('delete.promo.text');
    Route::resource('discounts', 'Admin\Discounts\DiscountsController', ['names' => 'discounts']);
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('plans', [App\Http\Controllers\Plans\PlansController::class, 'index']);
Route::get('subscribe', [App\Http\Controllers\Subscribe\SubscribeController::class, 'index']);
Route::get('checkout', [App\Http\Controllers\Checkout\CheckoutController::class, 'index']);
Route::get('buy-now-pay-later', [App\Http\Controllers\BuyNowPayLater\BuyNowPayLaterController::class, 'index']);
Route::get('products/{category}', 'Products\ProductsController@index');
Route::get('product/{category}/{product}', 'Products\ProductsController@show');
Route::get('make-model-year-engine', 'Products\ProductsController@makeModelYearSearch');

Route::get('/mailable', function () {
    $order = Order::find(12);
    $total =  DB::table('ordered_products')->select(\DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
    $sub_total = $total[0]->items_total ?? '0.00';
    $order->currency = '₦';

    return  new App\Mail\OrderReceipt($order, null, null, $sub_total);
});

Route::get('pages/{information}', 'Pages\PagesController@show');
Route::get('cart', 'Cart\CartController@index');
Route::resource('account', 'Account\AccountController', ['names' => 'account']);
Route::get('change/password', 'ChangePassword\ChangePasswordController@index');
Route::post('change/password', 'ChangePassword\ChangePasswordController@changePassword');
Route::get('wallet-balance', 'Wallets\WalletsController@walletBalnce');

Route::resource('wallets', 'Wallets\WalletsController', ['names' => 'wallets']);

Route::resource('orders', 'Orders\OrdersController', ['names' => 'orders']);
Route::resource('tracking', 'TrackOrder\TrackOrdersController', ['names' => 'track.orders']);
Route::resource('address', 'Address\AddressController', ['names' => 'address']);

Route::get('checkout', 'Checkout\CheckoutController@index')->name('checkout');
Route::post('checkout/confirm', 'Checkout\CheckoutController@confirm');

Route::post('checkout/coupon', 'Checkout\CheckoutController@coupon');

Route::group(['prefix' => '/api'], function () {
    Route::get('products/{category}',             'Api\Products\ProductsController@index');
    Route::get('filters/products/{category}',     'Api\Products\ProductsController@filters');
    Route::get('product/{category}/{product}',    'Api\Products\ProductsController@show');
    Route::get('/search',      'Api\Products\ProductsController@search');
    Route::get('cart',   'Api\Cart\CartController@loadCart');
    Route::post('cart',   'Api\Cart\CartController@store');
    Route::delete('cart/delete/{id}',   'Api\Cart\CartController@destroy');
    Route::resource('addresses',   'Api\Address\AddressController');
    Route::get('addresses/active/{id}',   'Api\Address\AddressController@makeDefault');
    Route::post('wishlist',   'Api\Favorites\FavoritesController@store');
    Route::get('wishlist',   'Api\Favorites\FavoritesController@index');
    Route::delete('wishlist/delete/{id}',   'Api\Favorites\FavoritesController@destroy');
    Route::get('blog/{blog}',   'Api\Blog\BlogController@show');
});


Route::controller(Products\ProductsController::class)->group(function () {
    Route::get('products/{category}', 'index');
});

Route::post('webhook/payment',     'WebHook\WebHookController@payment');
//Route::post('contact/store',     'Contact\ContactController@store');
Route::post('webhook/github',      'WebHook\WebHookController@gitHub');
