<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmationMail;

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

Route::group(['middleware' => 'checksession'], function (){
   
    Route::get('/test', [App\Http\Controllers\Home\HomeController::class, 'testMail']);
    Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home-guest');
    Route::get('/login', [App\Http\Controllers\Home\HomeController::class, 'login'])->name('login');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
    Route::get('/register', [App\Http\Controllers\Home\HomeController::class, 'register'])->name('register');
    Route::get('/shop', [App\Http\Controllers\Home\HomeController::class, 'shop'])->name('shop-guest');
    Route::get('/blog', [App\Http\Controllers\Home\HomeController::class, 'blog'])->name('blog-guest');
    Route::get('/contactus', [App\Http\Controllers\Home\HomeController::class, 'contactus'])->name('contactus-guest');
    Route::get('/about', [App\Http\Controllers\Home\HomeController::class, 'about'])->name('about-guest');
    Route::get('/product-info/{id}', [App\Http\Controllers\Home\ProductController::class, 'productInfo'])->name('product-info');
    Route::post('/register-user', [App\Http\Controllers\Home\HomeController::class, 'registerUser'])->name('register-user');
    Route::post('/login-user', [App\Http\Controllers\Home\HomeController::class, 'loginUser'])->name('login-user');
    Route::post('/authenticate', [App\Http\Controllers\Home\HomeController::class, 'authenticateUser'])->name('authenticate-user');
    Route::post('/reset-passcode', [App\Http\Controllers\Home\HomeController::class, 'resetPassCode'])->name('reset-passcode');
    Route::get('/shop-list', [App\Http\Controllers\Home\HomeController::class, 'shopList'])->name('shop-list');
    Route::post('/send-email', [App\Http\Controllers\Home\HomeController::class, 'sendEmail'])->name('send-email');
    Route::get('/single-blog/{id}', [App\Http\Controllers\Home\HomeController::class, 'singleBlog'])->name('single-blog');
    Route::post('/signup-email', [App\Http\Controllers\Home\HomeController::class, 'signupEmail'])->name('signup-email');
    Route::post('/reload-captcha', [App\Http\Controllers\Home\HomeController::class,'reloadCaptcha'])->name('reload-captcha');

    Route::get('/cart', [App\Http\Controllers\Home\HomeController::class, 'cart'])->name('cart');
    Route::get('/wishlist', [App\Http\Controllers\Home\HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('/checkout', [App\Http\Controllers\Home\HomeController::class, 'checkout'])->name('checkout');

    Route::namespace("Shop")->prefix("shop")->name("shop.")->group(function () {

        Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'shop'])->name('shop');
        Route::post('/add', [App\Http\Controllers\Home\ProductController::class, 'add'])->name('add');
        Route::post('/add-single-product', [App\Http\Controllers\Home\ProductController::class, 'addSingleProduct'])->name('add-single-product');
        Route::get('/cart-item', [App\Http\Controllers\Home\ProductController::class, 'cartItem'])->name('cart-item');
        Route::get('/shop-list', [App\Http\Controllers\Home\HomeController::class, 'shopList'])->name('shop-list');
        Route::post('/make-order', [App\Http\Controllers\Home\ProductController::class, 'createOrder'])->name('make-list');
        Route::post('/make-order-happi-points', [App\Http\Controllers\Home\ProductController::class, 'makeOrderByHappiPoints'])->name('make-order-happi-points');
        Route::post('/make-order-manual', [App\Http\Controllers\Home\ProductController::class, 'makeOrderManual'])->name('make-order-manual');
        Route::post('/make-order-cod', [App\Http\Controllers\Home\ProductController::class, 'makeOrderByCod'])->name('make-order-cod');
        Route::post('/create-user-comment', [App\Http\Controllers\Home\ProductController::class, 'createUserComment'])->name('create-user-comment');
        Route::post('/remove-cart-item', [App\Http\Controllers\Home\ProductController::class, 'removeCartItem'])->name('remove-cart-item');
        Route::post('/remove-wishlist-item', [App\Http\Controllers\Home\ProductController::class, 'removeWishlistItem'])->name('remove-wishlist-item');
        Route::post('/add-item-to-cart', [App\Http\Controllers\Home\ProductController::class, 'addItemToCart'])->name('add-item-to-cart');
        Route::post('/add-item-to-cart-input', [App\Http\Controllers\Home\ProductController::class, 'addItemToCartInput'])->name('add-item-to-cart-input');
        Route::post('/minus-item-to-cart', [App\Http\Controllers\Home\ProductController::class, 'minusItemToCart'])->name('minus-item-to-cart');
        
    });

});

Route::group(['middleware' => 'auth'], function (){

    Route::namespace("Home")->prefix("home")->name("home.")->group(function () {
        
        Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
        Route::get('/cart', [App\Http\Controllers\Home\HomeController::class, 'cart'])->name('cart');
        Route::get('/wishlist', [App\Http\Controllers\Home\HomeController::class, 'wishlist'])->name('wishlist');
        Route::get('/my-profile', [App\Http\Controllers\Home\HomeController::class, 'myProfile'])->name('my-profile');
        Route::get('/checkout', [App\Http\Controllers\Home\HomeController::class, 'checkout'])->name('checkout');
        Route::get('/my-orders', [App\Http\Controllers\Home\HomeController::class, 'myOrders'])->name('my-orders');
        Route::get('/single-blog/{id}', [App\Http\Controllers\Home\HomeController::class, 'singleBlog'])->name('single-blog');
        Route::get('/about', [App\Http\Controllers\Home\HomeController::class, 'about'])->name('about');

        Route::post('/update-profile-picture', [App\Http\Controllers\Home\HomeController::class, 'addProfilePicture'])->name('update-profile-picture');
        Route::post('/update-user-info', [App\Http\Controllers\Home\HomeController::class, 'updateUserInfo'])->name('update-user-info');
        Route::post('/update-user-password', [App\Http\Controllers\Home\HomeController::class, 'updateUserPassword'])->name('update-user-password');
        Route::post('/update-user-address', [App\Http\Controllers\Home\HomeController::class, 'updateUserAddress'])->name('update-user-address');

        Route::get('/test-payment', [App\Http\Controllers\Home\HomeController::class, 'testPaymenGcash'])->name('test-payment');

        Route::namespace("Shop")->prefix("shop")->name("shop.")->group(function () {

            Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'shop'])->name('shop');
            Route::post('/add', [App\Http\Controllers\Home\ProductController::class, 'add'])->name('add');
            Route::post('/add-single-product', [App\Http\Controllers\Home\ProductController::class, 'addSingleProduct'])->name('add-single-product');
            Route::get('/cart-item', [App\Http\Controllers\Home\ProductController::class, 'cartItem'])->name('cart-item');
            Route::get('/shop-list', [App\Http\Controllers\Home\HomeController::class, 'shopList'])->name('shop-list');
            Route::post('/make-order', [App\Http\Controllers\Home\ProductController::class, 'createOrder'])->name('make-list');
            Route::post('/make-order-happi-points', [App\Http\Controllers\Home\ProductController::class, 'makeOrderByHappiPoints'])->name('make-order-happi-points');
            Route::post('/make-order-manual', [App\Http\Controllers\Home\ProductController::class, 'makeOrderManual'])->name('make-order-manual');
            Route::post('/make-order-cod', [App\Http\Controllers\Home\ProductController::class, 'makeOrderByCod'])->name('make-order-cod');
            Route::post('/create-user-comment', [App\Http\Controllers\Home\ProductController::class, 'createUserComment'])->name('create-user-comment');
            Route::post('/remove-cart-item', [App\Http\Controllers\Home\ProductController::class, 'removeCartItem'])->name('remove-cart-item');
            Route::post('/remove-wishlist-item', [App\Http\Controllers\Home\ProductController::class, 'removeWishlistItem'])->name('remove-wishlist-item');
            Route::post('/add-item-to-cart', [App\Http\Controllers\Home\ProductController::class, 'addItemToCart'])->name('add-item-to-cart');
            Route::post('/add-item-to-cart-input', [App\Http\Controllers\Home\ProductController::class, 'addItemToCartInput'])->name('add-item-to-cart-input');
            Route::post('/minus-item-to-cart', [App\Http\Controllers\Home\ProductController::class, 'minusItemToCart'])->name('minus-item-to-cart');
            
        });

        Route::get('/blog', [App\Http\Controllers\Home\HomeController::class, 'blog'])->name('blog');
        Route::get('/contactus', [App\Http\Controllers\Home\HomeController::class, 'contactus'])->name('contactus-guest');
        Route::post('/send-email', [App\Http\Controllers\Home\HomeController::class, 'sendEmail'])->name('send-email');
        Route::post('/signup-email', [App\Http\Controllers\Home\HomeController::class, 'signupEmail'])->name('signup-email');
        Route::get('/product-info/{id}', [App\Http\Controllers\Home\ProductController::class, 'productInfo'])->name('product-info');
        Route::post('/artist-create-product', [App\Http\Controllers\Home\ProductController::class, 'artistCreateProduct'])->name('artist-create-product');
        Route::post('/create-website-blog', [App\Http\Controllers\Home\ProductController::class, 'createWebsiteBlog'])->name('create-website-blog');
        
    
    });

});

