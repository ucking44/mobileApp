<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OminiPaymentController;

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

Route::post('login', 'CheckoutController@login');
//Route::post('customer-register', 'CustomerApiController@customerRegister');
Route::post('register', 'CheckoutController@register');

// Route::post('login', 'ApiController@login');
// //Route::post('customer-register', 'CustomerApiController@customerRegister');
// Route::post('register', 'ApiController@register');
Route::post('/customer_registration', 'CheckoutController@customer_registration');

Route::group(['middleware' => 'auth.jwt'], function () {
    // Route::get('logout', 'ApiController@logout');
    Route::get('logout', 'CheckoutController@logout');

    //Route::get('user', 'ApiController@getAuthUser');
    Route::get('user', 'CheckoutController@getAuthUser');

    /////////////////////////  PRODUCT ROUTE  ////////////////////////////
    Route::get('products', 'ProductController@index');

    //////////////////  SHIPPING ROUTE  //////////////////
    Route::post('/save-shipping-details', 'CheckoutController@save_shipping_details');

    ////////////////// ORDER ROUTE ///////////////////
    Route::post('/order-place', 'CheckoutController@order_place');
    Route::get('/manage-order', 'CheckoutController@manage_order');
    Route::get('/view-order/{order_id}', 'CheckoutController@view_order');

    /////////////////////////////////  REVIEW ROUTE  ////////////////////////////////////
    Route::post('/reviews', 'ReviewsController@store');

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

Route::get('/', 'HomesController@index');

////////////////////////  SHOWING PRODUCT ROUTE  /////////////////////////
Route::get('/product_by_category/{category_id}', 'HomesController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomesController@show_product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomesController@product_details_by_id');


////////////////////   CART ROUTE   ////////////////////////
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::delete('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart', 'CartController@update_cart');

///////////////////  WISHLIST ROUTE  //////////////////
Route::post('/addToWishList', 'HomeController@wishList');
Route::get('/wishList', 'HomeController@view_wishList');
Route::get('/removeWishList/{id}', 'HomeController@removeWishList');

//////////////////////////////    PAYMENT ROUTE   ///////////////////////////////
/////////////////// OMINI PACKAGE IS OK ////////////////////////
//Route::get('payment', [OminiPaymentController::class, 'index']);
Route::post('/store/payment', [OminiPaymentController::class, 'store']);
Route::get('/success/payment', [OminiPaymentController::class, 'success']);
Route::put('/payment/details/{id}', [OminiPaymentController::class, 'payment_details']);


///////////////////   REVIEWS ROUTE  ///////////////////
Route::get('/product-show-review/{product_id}', 'HomeController@productReview');
Route::get('/show-reviews/{id}', 'ProductController@showReview');


//////////////////////  CATEGORY ROUTE  ////////////////////////
Route::get('/category', 'CategoryController@index');
Route::get('/category-id/{category_id}', 'CategoryController@category_by_id');


//////////////////////  MANUFACTURE ROUTE  ////////////////////////
Route::get('/manufacture', 'ManufactureController@index');
Route::get('/manufacture-id/{manufacture_id}', 'ManufactureController@manufacture_by_id');


// /////////////////////////  PRODUCT ROUTE  ////////////////////////////
// Route::get('products', 'ProductController@index');
Route::get('/products/{product_id}', 'ProductController@show_product_by_id');

////////////////////////  SEARCH ROUTE  ///////////////////////////
Route::get('/search-product', 'ProductController@search');
// Route::get('/search-product/{product_name}', 'ProductController@search');

Route::get('/search-category/{category_name}', 'CategoryController@search');

Route::get('/search-manufacture/{manufacture_name}', 'ManufactureController@search');

/////////////////////////////////  REVIEW ROUTE  ////////////////////////////////////
Route::get('/review', 'ReviewsController@index');

//Route::apiResource('products/{product}/reviews', 'ReviewController')->only('store', 'update', 'destroy');

