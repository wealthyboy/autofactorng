<?php

use Illuminate\Http\Request;

// Custom route that I just keep around long enough to run the migration and then remove
Route::get('/migrate', function() {
    Illuminate\Support\Facades\Migrator::run(database_path().'/migrations');
	$output = '';
    foreach (Illuminate\Support\Facades\Migrator::getNotes() as $note) {
        $output .= $note.'<br />';
    }

    return $output;
});




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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/permissions','PermissionController@index')->name('permissions');
Route::get('/permissions/create','PermissionController@create')->name('permissions_create');
Route::post('/permissions/create','PermissionController@store');

Route::get('/permissions/edit/{id}','PermissionController@edit')->name('edit_permissions');
Route::post('/permissions/edit/{id}','PermissionController@update');
Route::post('/permissions/delete','PermissionController@destroy')->name('delete_permissions');


Route::get('/users','UsersController@index')->name('users');
Route::get('/users/edit/{id}','UsersController@edit')->name('edit_users');
Route::post('/users/edit/{id}','UsersController@update');
Route::post('/users/delete','UsersController@destroy')->name('delete_users');


Route::get('/category','CategoryController@index')->name('category');
Route::get('/category/create','CategoryController@create')->name('create_category');
Route::post('/category/create','CategoryController@store');
Route::get('/category/edit/{id}','CategoryController@edit')->name('edit_category');
Route::post('/category/edit/{id}','CategoryController@update');
Route::post('/category/delete','CategoryController@destroy')->name('delete_category');
Route::get('/load_products_form','CategoryController@loadForm');


Route::get('/sub-category/{category_id}','SubCategoryController@index')->name('sub_category');
Route::get('/sub-category/create/{category_id}','SubCategoryController@create')->name('create_sub_category');
Route::get('/sub_category/{id}', 'SubCategoryController@edit')->name('edit_sub_category');
Route::post('/sub_category/{id}', 'SubCategoryController@update'); 

Route::post('/sub-category/create/{category_id}','SubCategoryController@store');
Route::post('/sub-category/delete','SubCategoryController@destroy')->name('delete_sub_category');

Route::get('/products','ProductController@index')->name('products');
Route::get('/products/create','ProductController@create')->name('create_products');
Route::post('/products/create','ProductController@store');
Route::get('/products/show/{id}','ProductController@show')->name('show_products');
Route::get('/products/invoice/{id}','ProductController@printInvoice')->name('print_invoice');

Route::get('/sales','SalesController@index')->name('sales');
Route::get('/sales/create','SalesController@create')->name('create_sales');
Route::post('/sales/create','SalesController@store');
Route::get('/sales/show/{id}','ProductController@show')->name('show_sales');
Route::get('/sales/invoice/{id}','SalesController@printInvoice')->name('print_sales');



Route::post('/products/delete','ProductController@destroy')->name('delete_products');

Route::get('/settings','SettingsController@index')->name('settings');







