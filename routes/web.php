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

use App\Http\Controllers\ClearCacheController;
use App\Http\Controllers\SitmapController;

Route::get('/generate-sitemap', SitmapController::class)->name('generateSitemap');
Route::get('/clear-cache', ClearCacheController::class);

Route::get('/clear-compiled', function() {
    $exitCode = Artisan::call('clear-compiled');
    // return what you want
});

Route::get('/storage-link', function () {
/*    $targetFolder = base_path().'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($targetFolder, $linkFolder); 
*/
    Artisan::call('storage:link');
});

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\PropertyController;
use App\Http\Controllers\Site\PropertyVerificationController;
use App\Http\Controllers\Site\UserController;
use App\Http\Controllers\Site\PropertyInvestmentController;
use App\Http\Controllers\Site\MessageController;
use App\Http\Controllers\Payment\StripeController;

Route::group(['middleware' => ['csp','lang']], function () {

     Route::get('/propertys',[HomeController::class,'propertyShow'])->name('property.show');

        Route::view('/payment', 'site.stripe')->name('site.payment');

        Route::post('create-payment-intent', [StripeController::class, 'createSubscription']);
        
 
    Route::get('/',[HomeController::class,'home'])->name('home');
    // Route::get('/',function(){
    //     return redirect('admin/dashboard');})->name('home');
    Route::get('/term-conditions',[HomeController::class,'terms'])->name('terms');
    Route::get('/about-us',[HomeController::class,'aboutUs'])->name('aboutus');
 
    Route::get('/sell-car-form',[CarController::class,'sellCar'])->name('sellCar');
    Route::post('/sellTempForm',[CarController::class,'sellTempForm'])->name('sellTempForm');
    Route::post('/sellMobileVerify',[CarController::class,'sellMobileVerify'])->name('sellMobileVerify');
    Route::post('/sellCar/send-otp', [CarController::class, 'sendOtp'])->name('sellCar.otp');

    Route::get('/app-features',[HomeController::class,'appFeatures'])->name('appFeatures');
    Route::get('/contact-us',[HomeController::class,'contactus'])->name('contactus');
    Route::post('/store-contact',[HomeController::class,'storeContact'])->name('storeContact');
    Route::get('/blogs',[HomeController::class,'blogs'])->name('blogs');
    Route::get('/blogs/{q}',[HomeController::class,'blogSingle'])->name('site.blogs.show');
    Route::get('/vendor-registeration',[HomeController::class,'vendorRegisteration'])->name('vendorRegisteration');
     Route::post('/store-vendor',[HomeController::class,'storeVendor'])->name('storeVendor')->middleware('throttle:3,1');

    Route::get('/services',[HomeController::class,'services'])->name('services');
    Route::post('/subscriber-store',[HomeController::class,'storeSubscriber'])->name('subscriber.store');

    Route::get('/our-clients',[HomeController::class,'ourClients'])->name('ourClients');
    Route::get('/privacy-policy',[HomeController::class,'privacy'])->name('privacy');
        
        Route::get('/jobs',[HomeController::class,'jobs'])->name('jobs');
        Route::get('/jobs/{q}',[HomeController::class,'jobSingle'])->name('jobs.single');
        Route::post('/jobs-store',[HomeController::class,'storeJob'])->name('storeJob');


        Route::get('/properties',[ProductController::class,'products'])->name('propertys');
        Route::get('/propertys/{q}',[ProductController::class,'productSingle'])->name('propertys.single');
        Route::post('/propertys/filter', [ProductController::class,'product_filter'])->name('product.filter');
        Route::view('/forget', 'site.auth.forget')->name('site.forget');
        
        Route::get('/forget-otp', function () {
            $mobile=  session()->get('forget_mobile');
            if(\App\Models\User::whereNotNull('code')->where('mobile', $mobile)->first()){
                return view('site.auth.forgetOtp');
            }else{
                return redirect()->route('site.forget');
            }
        })->name('site.forget.otp');

        Route::get('/otp', function () {
            $mobile=  session()->get('register_mobile');
            if(\App\Models\User::whereNotNull('code')->where('mobile', $mobile)->first()){
                return view('site.auth.otp');
            }else{
                return redirect()->route('register');
            }
        })->name('site.otp');

        Route::get('/changePassword', function () {
            $mobile=  session()->get('forget_mobile');
            if(\App\Models\User::whereNotNull('mobile_verified_at')->where('mobile', $mobile)->first()){
                return view('site.auth.changePassword');
            }else{
                return redirect()->route('forget.otp');
            }
        })->name('site.changePassword');

        Route::post('/send-otp', [UserController::class, 'sendOtp'])->name('send.otp');

        Route::post('/checkCodeActivate',[UserController::class,'checkCodeActivate'])->name('checkCodeActivate');
        Route::post('/clientSignup',[UserController::class,'clientSignup'])->name('clientSignup');


    Route::group(['middleware' => 'guest:web'], function () {

        Route::view('/signin', 'site.auth.signin')->name('site.signin');
        Route::get('/register',[UserController::class,'register'])->name('register');
        Route::post('/clientSignin',[UserController::class,'clientSignin'])->name('clientSignin');
        Route::get('/login',[UserController::class,'login'])->name('login');
        Route::post('/update_password_profile',[UserController::class,'update_password_profile'])->name('update_password_profile');

        Route::get('/continue_registeration', function () {
            if(session()->has('register_mobile')){
            $mobile=  session()->get('register_mobile');
            if(\App\Models\User::where('mobile_status','active')->where('mobile', $mobile)->first()){
                return view('site.auth.continue_registeration');
            }else{
                return redirect()->route('site.otp');
            }
            }elseif(session()->has('register_email')){
                $email=  session()->get('register_email');
                if(\App\Models\User::where('email_status','active')->where('email', $email)->first()){
                    return view('site.auth.continue_registeration');
                }else{
                    return redirect()->route('site.otp');
                }
            }
        })->name('site.continue_registeration');
        Route::post('/continueRegisterationForm',[UserController::class,'continueRegisterationForm'])->name('continueRegisterationForm');

    });


    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/check-new-messages', [MessageController::class, 'checkNewMessages']);
        Route::post('/mark-notifications-read', [MessageController::class, 'markNotificationsAsRead']);

        Route::get('/wishlist/add/{id}',[UserController::class,'addwish'])->name('user-wishlist-add');
        Route::post('/addcart/{id}',[UserController::class,'addCart'])->name('product.cart.add');


        Route::get('/profile',[UserController::class,'profile'])->name('profile');
        Route::get('/profile/{user}/add-property',[PropertyController::class,'addProperty'])->name('addProperty');

        Route::post('/profile/{user}/store-property',[PropertyController::class,'storeProperty'])->name('storeProperty');
        Route::get('/profile/{user}/property/{code}',[PropertyController::class,'linkProperty'])->name('linkProperty');

        Route::get('/profile/{user}/card',[PropertyController::class,'userCard'])->name('userCard');
        Route::get('/verify-property/{token}', [PropertyVerificationController::class, 'verify'])->name('property.verify.link');
        Route::get('/property/{listing_number}', [PropertyVerificationController::class, 'show'])->name('property.show');
        Route::post('/properties/{property}/invest', [PropertyInvestmentController::class, 'store'])->name('property.invest');

        Route::post('profile-update', [UserController::class,'update_profile'])->name('edit-profile');
        Route::post('photo-update', [UserController::class,'update_photo'])->name('edit-photo');
        Route::get('/change-password',[UserController::class,'changePassword'])->name('change-password'); 
        Route::post('update-password', [UserController::class,'update_password_profile'])->name('update-password-profile');
        Route::get('/favorites',[UserController::class,'favorites'])->name('favorites'); 
        Route::get('/notifications',[UserController::class,'notifications'])->name('notifications'); 

        Route::post('/ulogout', [UserController::class,'ulogout'])->name('ulogout');  
        Route::get('/my-ads',[UserController::class,'ads'])->name('ads'); 
        Route::get('/track-ads',[UserController::class,'trackOrders'])->name('trackOrders'); 
        Route::post('/orders/{order}',[UserController::class,'changeStatus'])->name('orders.changeStatus'); 
        Route::get('/my-cars',[UserController::class,'usercars'])->name('usercars'); 

    });

});
