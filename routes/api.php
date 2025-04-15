<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\AuthController;
use App\Http\Controllers\Api\V1\User\UserAddressController;

use App\Http\Controllers\Api\V1\Products\HomeController;
use App\Http\Controllers\Api\V1\Products\CartController;
use App\Http\Controllers\Api\V1\Products\OrderController;
use App\Http\Controllers\Api\V1\Products\FavoritesController;
use App\Http\Controllers\Api\V1\Home\MainController;

Route::group([
    'namespace'  => 'Api',  'middleware' => ['CheckLang','csp'],
], function () {

	Route::prefix('v1')->group(function () {
	    Route::get('setting', [MainController::class, 'getSetting']);
		Route::get('/locations/governorates', [UserAddressController::class, 'getGovernorates']);
    	Route::get('/locations/cities/{governorate_id}', [UserAddressController::class, 'getCities']);
    	Route::get('/locations/districts/{city_id}', [UserAddressController::class,'getDistricts']);
    	Route::get('/categorys', [HomeController::class,'getCategorys']);
    	Route::get('/brands', [HomeController::class,'getBrands']);
    	Route::get('/products', [HomeController::class,'getStoreProducts']);
    	Route::get('/products/{id}', [HomeController::class,'getSingleProduct']);

    	Route::get('/pages', [HomeController::class,'getPages']);

    });

	Route::prefix('v1/user')->group(function () {
	    Route::post('register', [AuthController::class, 'register'])->middleware('throttle:5,1');
	    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
	    Route::post('/activate-account', [AuthController::class, 'activateAccount']);
	    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
	    Route::post('check-reset-code', [AuthController::class, 'checkResetCode'])->middleware('throttle:5,1');
	    Route::post('reset-password', [AuthController::class, 'resetPassword']);

	    Route::middleware(['jwt.auto_refresh','jwt.auth'])->group(function () {
	        Route::post('logout', [AuthController::class, 'logout']);
	        Route::post('refresh', [AuthController::class, 'refresh']);
	        Route::get('profile', [AuthController::class, 'profile']);
	        Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    		Route::put('/update-photo', [AuthController::class, 'updatePhoto']);
	        Route::post('change-password', [AuthController::class, 'changePassword']);
	    	Route::post('verify-mobile', [AuthController::class, 'verifyMobile'])->middleware('throttle:3,10');
	    	Route::delete('delete-account', [AuthController::class, 'deleteAccount']);
			Route::get('/notifications', [AuthController::class, 'getNotifications']);

            Route::post('/change-mobile/request', [AuthController::class, 'requestChangeMobile']);
            Route::post('/change-mobile/verify', [AuthController::class, 'verifyChangeMobile']);

		    Route::get('/user-addresses', [UserAddressController::class, 'index']);
		    Route::post('/user-addresses', [UserAddressController::class, 'store']);
		    Route::get('/user-addresses/{userAddress}', [UserAddressController::class, 'show']);
		    Route::put('/user-addresses/{userAddress}', [UserAddressController::class, 'update']);
		    Route::delete('/user-addresses/{userAddress}', [UserAddressController::class, 'destroy']);
		    //endpoints applied by user and products
			Route::prefix('cart')->group(function () {
		        Route::get('/', [CartController::class, 'index']);
		        Route::post('/', [CartController::class, 'addToCart']);
		        // Route::put('/{cart_id}', [CartController::class, 'updateCart']); 
		        Route::delete('/{cart_id}', [CartController::class, 'removeFromCart']);
		        Route::delete('/', [CartController::class, 'clearCart']);
		        Route::get('/apply-coupon', [OrderController::class, 'applyCoupon']); 
		    });
		    
		    Route::get('/orders', [OrderController::class, 'getOrders']); 
            Route::get('/orders/{order_id}', [OrderController::class, 'getOrderDetails']); 
            Route::post('/orders/checkout', [OrderController::class, 'checkout']);
            Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder']); 
            Route::post('/orders/{order}/return', [OrderController::class, 'returnOrder']); 
            Route::get('/orders/{order}/can-deliver', [OrderController::class, 'checkOrderDeliver']); 
          
            Route::get('/wallet', [AuthController::class, 'wallet']); 

			Route::post('/favorites/toggle', [FavoritesController::class, 'toggleFavorite']);
    		Route::get('/favorites', [FavoritesController::class, 'getUserFavorites']);
    		Route::post('products/review', [HomeController::class, 'addReview']);

	    });
	});
});
