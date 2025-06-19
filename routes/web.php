<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\WelcomeNotification;
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

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\HomeController@index')->name('admin_home');
    Route::get('/export', 'Admin\Exports\ExportsController@index');

    Route::get('/maintainance/mode', 'Admin\Live\LiveController@index')->name('maintainance');
    Route::get('live', 'Admin\Live\LiveController@activate');
    Route::resource('activities', 'Admin\Activity\ActivityController', ['names' => 'admin.activities']);
    Route::get('reports', 'Admin\Account\AccountsController@index');
    Route::get('account/filter', 'Admin\Account\AccountsController@index')->name('filter_sales');
    Route::post('customers/wallet/{id}', 'Admin\Customers\CustomersController@fundWallet');
    Route::post('/update/status', 'Admin\Orders\OrdersController@updateStatus');
    Route::resource('credits',  'Admin\AutoCredit\AutoCreditController', ['names' => 'admin.credits']);

    Route::resource('blogs',  'Admin\Blog\BlogController', ['names' => 'blogs']);


    Route::resource('customers', 'Admin\Customers\CustomersController', ['name' => 'customers']);


    Route::get('orders/invoice/{id}', 'Admin\Orders\OrdersController@invoice')->name('order.invoice');
    Route::post('orders/status', 'Admin\Orders\OrdersController@updateStatus');

    Route::get('orders/dispatch/{id}', 'Admin\Orders\OrdersController@dispatchNote')->name('order.dispatch.note');
    Route::resource('location', 'Admin\Location\LocationController', ['names' => 'location']);
    Route::resource('engines', 'Admin\Engines\EnginesController', ['names' => 'engines']);
    Route::get('products/download-products-sql', 'Admin\Product\ProductController@downloadProductSql');




    //Route::post('register','Admin\Users\UsersController@create')->name('create.admin.users');

    Route::resource('permissions', 'Admin\Permission\PermissionsController', ['names' => 'permissions']);
    Route::post('upload/image', 'Admin\Image\ImagesController@store');
    Route::post('delete/image', 'Admin\Image\ImagesController@undo');
    Route::post('upload', 'Admin\Uploads\UploadsController@store');
    Route::get('delete/upload', 'Admin\Uploads\UploadsController@destroy');
    Route::resource('users',  'Admin\Users\UsersController', ['names' => 'admin.users']);
    //Route::resource('forums',  'Admin\Forums\ForumController', ['names' => 'admin.forums']);

    Route::post('/products/update-price/{id}', 'Admin\Product\ProductController@updatePrice');
    Route::resource('banners', 'Admin\Design\BannersController', ['names' => 'banners']);
    Route::resource('pages', 'Admin\Information\InformationController', ['names' => 'pages']);
    Route::resource('settings', 'Admin\Settings\SettingsController', ['names' => 'settings']);

    Route::resource('shipping', 'Admin\Shipping\ShippingController', ['names' => 'shipping']);
    Route::resource('location', 'Admin\Location\LocationController', ['names' => 'location']);
    Route::resource('attributes', 'Admin\Attributes\AttributesController', ['names' => 'attributes']);
    Route::resource('payments', 'Admin\Payments\PaymentController', ['name' => 'payments']);
    Route::resource('rates', 'Admin\CurrencyRates\CurrencyRatesController', ['name' => 'rates']);
    Route::resource('vouchers', 'Admin\Vouchers\VouchersController', ['names' => 'vouchers']);
    Route::get('products/search/makemodelyear', 'Admin\Product\ProductController@makeModelYearSearch');
    Route::get('/related/products', 'Admin\Product\ProductController@getRelatedProducts');
    Route::delete('/related_products/{id}', 'Admin\RelatedProducts\RelatedProductsController@destroy');

    Route::resource('products', 'Admin\Product\ProductController', ['names' => 'products']);

    Route::get('/download-products', 'Admin\Product\ProductController@downloadProducts');


    Route::resource('category', 'Admin\Category\CategoryController', ['name' => 'category']);
    Route::post('category/delete/image', 'Admin\Category\CategoryController@undo');
    Route::resource('reviews',  'Admin\Reviews\ReviewsController', ['names' => 'admin.reviews']);
    Route::resource('orders', 'Admin\Orders\OrdersController', ['names' => 'admin.orders']);
    Route::resource('brands', 'Admin\Brand\BrandsController', ['names' => 'brands']);
    Route::resource('promos', 'Admin\Promo\PromoController', ['names' => 'promos']);
    Route::get('promo-text/create/{id}', 'Admin\PromoText\PromoTextController@create')->name('create.promo.text');
    Route::get('promo-text/edit/{id}', 'Admin\PromoText\PromoTextController@edit')->name('edit_promo_text');
    Route::post('promo-text/edit/{id}', 'Admin\PromoText\PromoTextController@update');
    Route::post('promo-text/create/{id}', 'Admin\PromoText\PromoTextController@store');
    Route::get('promo-text/delete/{id}', 'Admin\PromoText\PromoTextController@destroy')->name('delete.promo.text');
    Route::resource('discounts', 'Admin\Discounts\DiscountsController', ['names' => 'discounts']);
    Route::resource('forums', 'Admin\Forums\ForumController', ['names' => 'admin.forums']);
    Route::post('reply/{id}/delete', 'Admin\Forums\ForumController@deleteReply');

    Route::resource('trackings', 'Admin\Tracking\TrackingController', ['names' => 'trackings']);
    Route::resource('car-reviews', 'Admin\CarReviews\CarReviewsController', ['names' => 'admin.car_reviews']);
    Route::resource('forum-category', 'Admin\ForumCategory\ForumCategoryController', ['names' => 'admin.forum-category']);
});


Route::post('password/reset/link',           'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('validate/token/{token}',         'Auth\ForgotPasswordController@validateToken');

Auth::routes();


Route::get('/notification', function () {
    $dd =  self::sendWhatsApMessage(2349081155505, "jacob");

    dd($dd);
});


Route::get('/reset-quantities', function () {
    Product::query()->update(['quantity' => 0]);
    return 'All product quantities set to 0.';
});


Route::group(['middleware' => ['tracking']], function () {


    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

    Route::get('plans', [App\Http\Controllers\Plans\PlansController::class, 'index']);
    Route::get('buy-now-pay-later', [App\Http\Controllers\BuyNowPayLater\BuyNowPayLaterController::class, 'index']);

    Route::get('subscribe', [App\Http\Controllers\Subscribe\SubscribeController::class, 'index']);
    Route::get('checkout', [App\Http\Controllers\Checkout\CheckoutController::class, 'index']);
    Route::get('products/{category}', 'Products\ProductsController@index');
    Route::get('product/{category}/{product}', 'Products\ProductsController@show');
    Route::get('make-model-year-engine', 'Products\ProductsController@makeModelYearSearch');
    Route::get('auto-complete', 'Products\ProductsController@autoComplete');
    Route::get('search', 'Products\ProductsController@search');
    Route::post('forum/{topic}/toggle-like', 'Forum\ForumController@toggle');
    Route::post('forum/{replyId}/reply-like', 'Forum\ForumController@toggleReplyLikes');


    Route::resource('forum', 'Forum\ForumController', ['names' => 'forum']);

    Route::resource('car-reviews', 'CarReviews\CarReviewsController', ['names' => 'car.reviews']);
    Route::resource('topic', 'Topics\TopicsController', ['names' => 'topics']);
    Route::post('reply', [App\Http\Controllers\Replies\ReplyController::class, 'store']);


    Route::get('cart', 'Cart\CartController@index');
    Route::post('cart/meta', 'Cart\CartController@meta');
    Route::resource('account', 'Account\AccountController', ['names' => 'account']);
    Route::get('change/password', 'ChangePassword\ChangePasswordController@index');
    Route::post('change/password', 'ChangePassword\ChangePasswordController@changePassword');
    Route::get('wallet-balance', 'Wallets\WalletsController@walletBalnce');
    Route::get('video-tips', 'HowTo\HowToController@index');
    Route::post('reset/password', 'Auth\ResetPasswordController@reset');
    Route::resource('wallets', 'Wallets\WalletsController', ['names' => 'wallets']);
    Route::resource('orders', 'Orders\OrdersController', ['names' => 'orders']);
    Route::get('tracking', 'TrackOrder\TrackOrdersController@index');
    Route::post('tracking', 'TrackOrder\TrackOrdersController@getOrderStatus');
    Route::resource('address', 'Address\AddressController', ['names' => 'address']);
    Route::get('checkout', 'Checkout\CheckoutController@index')->name('checkout');
    Route::post('checkout/confirm', 'Checkout\CheckoutController@confirm');
    Route::post('checkout/coupon', 'Checkout\CheckoutController@coupon');
});






Route::group(['prefix' => '/api', 'middleware' => ['tracking']], function () {
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
    Route::get('years',   'Api\Years\YearsController@index');
    Route::post('newsletter/signup',  'Api\NewsLetter\NewsLetterController@store');
});

Route::get('errors',                  'Errors\ErrorsController@index');



Route::controller(Products\ProductsController::class)->group(function () {
    Route::get('products/{category}', 'index');
    Route::get('clear-cookies', 'clearMMYCookies');
});

Route::get('reviews/{id}', 'Api\Reviews\ReviewsController@index');
Route::post('reviews/store',  'Api\Reviews\ReviewsController@store');
//xRoute::post('brands/{brand}', 'Brands\BrandsController@index');



Route::post('webhook/payment',     'WebHook\WebHookController@payment');
Route::post('webhook/payment/zilla',     'WebHook\WebHookController@zilla');

//Route::post('contact/store',     'Contact\ContactController@store');
Route::post('webhook/github',      'WebHook\WebHookController@gitHub');
Route::get('pages/{information}', 'Pages\PagesController@index');
