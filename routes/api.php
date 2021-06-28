<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    // Route::get('products', 'ProductController@index');
    // Route::get('/products/{product_id}', 'ProductController@show');

    Route::get('user', 'ApiController@getAuthUser');

    //Route::get('/all-product', 'ProductController@all_product');
    // Route::get('products', 'ProductController@index');
    // Route::post('/save-product', 'ProductController@save_product');
    // Route::get('products/{id}', 'ProductController@show');
    // Route::post('products', 'ProductController@store');
    // Route::put('products/{id}', 'ProductController@update');
    // Route::delete('products/{id}', 'ProductController@destroy');
});

Route::get('users/profile', ['uses' => 'UsersController@profile', 'as' => 'users.profile']);
Route::get('users/block', ['uses' => 'UsersController@blockUser', 'as' => 'users.block']);

///////////////////////////////////// SERVICE ROUTE ////////////////////////////////////////////
Route::get('/service', 'ServiceController@index');
Route::get('/create/service', 'ServiceController@create');
Route::post('/store/service', 'ServiceController@store');
Route::get('/edit/service/{id}', 'ServiceController@edit');
Route::put('/update/service/{id}', 'ServiceController@update');
Route::get('/delete/service/{id}', 'ServiceController@destroy');
Route::get('/service/unactive/{id}', 'ServiceController@unactive_service');
Route::get('/service/active/{id}', 'ServiceController@active_service');

///////////////////////  APPOINTMENT ROUTE  //////////////////////////////
Route::get('/appointment', 'AppointmentController@index');
Route::get('/create/appointment', 'AppointmentController@create');
Route::post('/save/appointment', 'AppointmentController@store');

//Route::get('/', 'HomesController@index');

Route::get('/product_by_category/{category_id}', 'HomesController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomesController@show_product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomesController@product_details_by_id');


////////////////////   CART ROUTE   ////////////////////////
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart', 'CartController@update_cart');




Route::get('/category', 'CategoryController@index');
Route::get('/category-id/{category_id}', 'CategoryController@category_by_id');
Route::post('/save-category', 'CategoryController@save_category');
//Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::get('/unactive_category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');


Route::get('/manufacture', 'ManufactureController@index');
Route::get('/manufacture-id/{manufacture_id}', 'ManufactureController@manufacture_by_id');
Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
//Route::get('/edit-manufacture/{id}', 'ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{id}', 'ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{id}', 'ManufactureController@delete_manufacture');
Route::get('/unactive_manufacture/{id}', 'ManufactureController@unactive_manufacture');
Route::get('/active_manufacture/{id}', 'ManufactureController@active_manufacture');


Route::get('products', 'ProductController@index');
Route::get('/products/{product_id}', 'ProductController@show');
Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/add-product', 'ProductController@index');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
Route::get('/active_product/{product_id}', 'ProductController@active_product');

Route::get('/search-product/{product_name}', 'ProductController@search');

Route::get('/search-category/{category_name}', 'CategoryController@search');

Route::get('/search-manufacture/{manufacture_name}', 'ManufactureController@search');

Route::apiResource('products/{product}/reviews', 'ReviewController')->only('store', 'update', 'destroy');

