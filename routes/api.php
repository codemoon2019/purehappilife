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

Route::post('login',  [App\Http\Controllers\API\AuthenticationController::class, 'login']);
Route::post('register', [App\Http\Controllers\API\AuthenticationController::class, 'register']);
Route::post('/get-payment-method', [App\Http\Controllers\Home\ProductController::class, 'getPaymentMethods'])->name('get-payment-method');
Route::post('/initiate-payment', [App\Http\Controllers\Home\ProductController::class, 'initiatePayment'])->name('initiate-payment');
Route::post('/submit-additional-details', [App\Http\Controllers\Home\ProductController::class, 'submitAdditionalDetails'])->name('submit-additional-details');
Route::get('/validate-payment', [App\Http\Controllers\Home\ProductController::class, 'validatePayment'])->name('validate-payment');

//Route::group(['middleware' => 'auth:api'], function(){

    Route::post('details', [App\Http\Controllers\API\AuthenticationController::class, 'details']);
    Route::post('create-product', [App\Http\Controllers\API\ProductController::class, 'createProduct']);
    Route::post('update-product', [App\Http\Controllers\API\ProductController::class, 'updateProduct']);
    Route::post('delete-product', [App\Http\Controllers\API\ProductController::class, 'deleteProduct']);
    Route::post('retrieve-single-product-info', [App\Http\Controllers\API\ProductController::class, 'retrieveSingleProductInfo']);
    Route::post('delete-product-image', [App\Http\Controllers\API\ProductController::class, 'deleteProductImage']);
    Route::post('order-list', [App\Http\Controllers\API\ProductController::class, 'orderList']);
    Route::post('guest-order-list', [App\Http\Controllers\API\ProductController::class, 'guestOrderList']);
    Route::post('order-list-driver', [App\Http\Controllers\API\ProductController::class, 'orderListDriver']);
    Route::post('order-details', [App\Http\Controllers\API\ProductController::class, 'orderDetails']);
    Route::post('guest-order-details', [App\Http\Controllers\API\ProductController::class, 'orderDetailsGuest']);
    Route::post('update-order-status', [App\Http\Controllers\API\ProductController::class, 'updateOrderStatus']);
    Route::post('update-all-order-status', [App\Http\Controllers\API\ProductController::class, 'updateAllOrderStatus']);
    Route::post('product-list', [App\Http\Controllers\API\ProductController::class, 'productList']);
    Route::get('dashboard-report', [App\Http\Controllers\API\ProductController::class, 'dashBoardReport']);
    Route::get('guest-dashboard-report', [App\Http\Controllers\API\ProductController::class, 'guestDashBoardReport']);
    Route::post('system-user-list', [App\Http\Controllers\API\UserController::class, 'userList']);
    Route::post('create-website-blog', [App\Http\Controllers\API\SystemController::class, 'createWebsiteBlog']);
    Route::post('website-blog-list', [App\Http\Controllers\API\SystemController::class, 'websiteBlogList']);
    Route::post('update-driver', [App\Http\Controllers\API\ProductController::class, 'updateDriver']);
    Route::get('notification-list', [App\Http\Controllers\NotificationController::class, 'notificationList']);
    Route::get('notification-header-list', [App\Http\Controllers\NotificationController::class, 'notificationHeaderList']);
    Route::post('update-multiple-order-status', [App\Http\Controllers\API\ProductController::class, 'updateMultipleOrderStatus']);
    Route::post('update-website-blog', [App\Http\Controllers\API\SystemController::class, 'updateWebsiteBlog']);
    

//});
