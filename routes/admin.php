<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\RequestController;
use App\Http\Controllers\Dashboard\FinancialTransactionController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\SubscriberController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\ReferralController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\FcmNotificationsController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\PendingVendorController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\WalletController;

Route::get('/change-language/{lang}', [HomeController::class,'changeLang']);

Route::group(['prefix' => 'admin', 'middleware' => ['lang','csp']], function () {

    Route::get('/login', [HomeController::class, 'loginPage'])->name('dashboard.login')->middleware('adminGuest');
    Route::post('/signin', [HomeController::class, 'signin'])->name('admin.login')->middleware(['adminGuest','throttle:3,1']);

    Route::group([ 'middleware' => 'IsAdmin'], function () {
        Route::get("/videos/how-to-use", function(){
           return view("admin.up_videos");
        });
        
        Route::post('/clear-cache/store-created', function () {
            Cache::forget('store_created');
            return response()->json(['message' => 'Cache cleared']);
        })->name('cache.clear.store_created');

        
        Route::post('/clear-cache/vendor_created', function () {
            Cache::forget('vendor_created');
            return response()->json(['message' => 'Cache cleared']);
        })->name('cache.clear.vendor_created');

        // Invoice routes
        Route::get('/api/products/{id}/price', function ($id) {
            $product = \App\Models\Product::find($id);
            return response()->json(['price' => $product ? $product->price : 0]);
        });
        Route::prefix('invoices')->group(function () {
            // Show form to create an invoice
                Route::post('/invoices/storeTemplate', [InvoiceController::class, 'storeTemplate'])->name('invoices.storeTemplate');
            Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
            // Store the invoice
            Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
            // Show a single invoice
            Route::get('/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
            // Generate and download invoice PDF
            Route::get('/{id}/pdf/{templateId}', [InvoiceController::class, 'generatePDF'])->name('invoices.generatePDF');
        });

        Route::resource('locations', LocationController::class);
        Route::delete('locationsDeleteAll', [LocationController::class,'deleteAll'])->name('locations.deleteAll');
        Route::prefix('locations')->group(function () {
            Route::get('cities/{governorate_id}', [LocationController::class, 'getCities']);
            Route::get('districts/{city_id}', [LocationController::class, 'getDistricts']);
        });


        Route::get('/check-new-messages', [MessageController::class, 'checkNewMessages']);
        Route::post('/mark-notifications-read', [MessageController::class, 'markNotificationsAsRead']);
        Route::post('model-sortable',[HomeController::class,'updateColumns'])->name('modelSortable');

        Route::get('/adminLogout', [HomeController::class, 'adminLogout']);
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/notifications', [HomeController::class, 'notifications']);
        Route::put('/read/{id}', [HomeController::class, 'read'])->name('read_notify');
        Route::post('/change-password', [HomeController::class, 'changePassword'])->name('changePassword');

        Route::get('/settings', [SettingsController::class, 'index']);
        Route::get('/settings/basic', [SettingsController::class, 'basic'])->name('settings.basic');
        Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.updateSetting');
        Route::get('/settings/restore-data', [SettingsController::class, 'restoreData'])->name('settings.restoreData');
        Route::get('/settings/restore-data/{q}', [SettingsController::class, 'restoreDataValue'])->name('settings.restoreData.data');
 
        Route::get('/settings/website-pages', [SettingsController::class, 'websitePages'])->name('settings.websitePages');
        Route::get('/settings/website-pages/{control}', [SettingsController::class, 'websitePagesValue'])->name('settings.websitePages.data');
        Route::put('/settings/update-landing', [SettingsController::class, 'updateLanding'])->name('settings.updateLanding');

        Route::get('/settings/working-hours', [SettingsController::class, 'workingHours'])->name('settings.workingHours');
        Route::put('/settings/working-hours/update/{id}', [SettingsController::class, 'updateWorkingHours'])->name('settings.updateWorkingHours');
        Route::get('/settings/seo', [SettingsController::class, 'seoPage'])->name('settings.seo');
        Route::put('/settings/update-seo', [SettingsController::class, 'updateSeo'])->name('settings.updateSeo');
        Route::get('/settings/sending-notifications', [SettingsController::class, 'sendingNotifications'])->name('sending_notifications.index');
        Route::get('/settings/activity-logs', [SettingsController::class, 'activityLogs'])->name('settings.activityLogs');
        Route::get('/settings/invoice-template', [SettingsController::class, 'invoiceTemplate'])->name('settings.invoiceTemplate');
        Route::post('/invoices/storeTemplate', [SettingsController::class, 'storeTemplate'])->name('invoices.storeTemplate');

        Route::resource('/roles', RolesController::class);
        Route::delete('rolesDeleteAll', [RolesController::class,'deleteAll'])->name('roles.deleteAll');
        Route::resource('/fcm_notifications', FcmNotificationsController::class);

        // -------------------------------New Routes-------------------------------
        Route::resource('/banners', BannerController::class);
        Route::delete('bannersDeleteAll', [BannerController::class,'deleteAll']);


        Route::resource('coupons', CouponController::class);
        Route::delete('couponsDeleteAll', [CouponController::class,'deleteAll'])->name('coupons.deleteAll');
        Route::post('change-admin-status/{coupon}', [CouponController::class,'changeAdminStatus'])->name('coupons.changeAdminStatus');

        Route::resource('/categorys', CategoryController::class);
        Route::delete('categorysDeleteAll', [CategoryController::class,'deleteAll'])->name('categorys.deleteAll');
        Route::post('categorychangeInHome/{category}', [CategoryController::class,'changeInHome'])->name('categorys.changeInHome');
        Route::post('categorychangeStatus/{category}', [CategoryController::class,'changeStatus'])->name('categorys.changeStatus');




        Route::resource('/stores', StoreController::class);
        Route::delete('storesDeleteAll', [StoreController::class,'deleteAll'])->name('stores.deleteAll');
        Route::post('storechangeInHome/{store}', [StoreController::class,'changeInHome'])->name('stores.changeInHome');
        Route::post('storechangeStatus/{store}', [StoreController::class,'changeStatus'])->name('stores.changeStatus');



        Route::resource('/brands', BrandController::class);
        Route::delete('brandsDeleteAll', [BrandController::class,'deleteAll'])->name('brands.deleteAll');
        Route::post('brandchangeInHome/{brand}', [BrandController::class,'changeInHome'])->name('brands.changeInHome');
        Route::post('brandchangeStatus/{brand}', [BrandController::class,'changeStatus'])->name('brands.changeStatus');


        Route::resource('/blogs', BlogController::class);
        Route::delete('blogsDeleteAll', [BlogController::class,'deleteAll'])->name('blogs.deleteAll');
        Route::post('blogchangeStatus/{blog}', [BlogController::class,'changeStatus'])->name('blogs.changeStatus');

        Route::resource('/pending_vendors', PendingVendorController::class);
        Route::delete('pending_vendorsDeleteAll', [PendingVendorController::class,'deleteAll'])->name('pending_vendors.deleteAll');

        Route::resource('/countries', CountryController::class);
        Route::delete('countriesDeleteAll', [CountryController::class,'deleteAll']);

        Route::resource('/cities', CityController::class);
        Route::delete('citiesDeleteAll', [CityController::class,'deleteAll']);

        Route::resource('/users', UserController::class);
        Route::delete('usersDeleteAll', [UserController::class,'deleteAll'])->name('users.deleteAll');
        Route::delete('userAddressDelete/{id}', [UserController::class,'userAddressDelete'])->name('useraddresses.destroy');
        Route::delete('userWishlistsDelete/{id}', [UserController::class,'userWishlistsDelete'])->name('userwishlists.destroy');
        Route::get('/users/show_overall_rate/{user}', [UserController::class,'showOverallRate'])->name('showOverallRate');
        Route::post('userchangeInHome/{user}', [UserController::class,'changeInHome'])->name('users.changeInHome');
        
        Route::post('/users/block', [UserController::class, 'blockClient'])->name('users.block');
        Route::post('/users/copy-review-link', [UserController::class, 'copyReviewLink'])->name('users.copyReviewLink');
        Route::put('userchangeStatus/{user}', [UserController::class,'changeStatus'])->name('users.changeStatus');

        
        Route::resource('/orders', OrderController::class);
        Route::delete('ordersDeleteAll', [OrderController::class,'deleteAll'])->name('orders.deleteAll');;
        Route::get('download-pdf', [OrderController::class,'download_fatora'])->name('download-pdf');
        Route::get('print-pdf', [OrderController::class,'print_fatora'])->name('print-pdf');
        Route::post('/ordersDetail/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::post('/orders/update-assign-to', [OrderController::class, 'updateAssignTo'])->name('orders.updateAssignTo');
        Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('/orders/update-notes-to-order', [OrderController::class, 'updateNotesToOrder'])->name('orders.updateNotesToOrder');
        Route::post('/fetch-shipping', [OrderController::class, 'fetchShipping']);
        Route::post('/fetch-capacitys', [OrderController::class, 'fetchCapacity']);
        Route::post('/fetch-prices', [OrderController::class, 'fetchPrice']);

        Route::resource('/requests', RequestController::class);
        Route::delete('requestsDeleteAll', [RequestController::class,'deleteAll']);
        Route::get('generate-pdf', [RequestController::class,'pdfview'])->name('generate-pdf');
        Route::post('change_reservation_status', [RequestController::class,'changeReservationStatus'])->name('change_reservation_status');
        

        Route::get('orders/{id}/review', [OrderController::class,'orderReview'])->name('orders.review');

        Route::resource('/pages', PageController::class);
        Route::delete('pagesDeleteAll', [PageController::class,'deleteAll'])->name('pages.deleteAll');
        Route::post('pagechangeStatus/{page}', [PageController::class,'changeStatus'])->name('pages.changeStatus');

        Route::resource('/contacts', ContactController::class);
        Route::delete('contactsDeleteAll', [ContactController::class,'deleteAll'])->name('contacts.deleteAll');
        Route::post('/send_email/{contact}', [ContactController::class,'send_email'])->name('contacts.send_email');
        Route::post('contactchangeStatus/{contact}', [ContactController::class,'changeStatus'])->name('contacts.changeStatus');

        Route::resource('/products', ProductController::class);
        Route::delete('productsDeleteAll', [ProductController::class,'deleteAll'])->name('products.deleteAll');
        Route::post('/fetch-subcategory', [ProductController::class, 'fetchSubcategory']);
        Route::post('productcloneProduct/{product}', [ProductController::class,'cloneProduct'])->name('products.cloneProduct');

        Route::post('productchangeStatus/{product}', [ProductController::class,'changeStatus'])->name('products.changeStatus');
        Route::get('product_reviews', [ProductController::class,'productReviews'])->name('products.reviews');
        Route::delete('product_reviewsDeleteAll', [ProductController::class,'productReviewsdeleteAll']);
        Route::post('product_reviewstoggleStatus/{product}', [ProductController::class,'productReviewstoggleStatus'])->name('product_reviews.toggleStatus');
        Route::post('toggleStatus/{product}', [ProductController::class,'toggleStatus'])->name('products.toggleStatus');
        Route::delete('product_reviews/{product}', [ProductController::class,'productReviewDelete'])->name('product_reviews.destroy');

        Route::get('product_wishlists', [ProductController::class,'productWishlists'])->name('products.wishlists');
        Route::delete('product_wishlistsDeleteAll', [ProductController::class,'productWishlistsdeleteAll']);
        Route::delete('product_wishlists/{product}', [ProductController::class,'productWishlistDelete'])->name('product_wishlists.destroy');

        Route::post('projects/media', [ProductController::class, 'storeMedia'])->name('projects.storeMedia');
        Route::post('/product/image/delete', [ProductController::class, 'deleteImage'])->name('product.image.delete');


        Route::post('/productsDetail/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::post('/product/image/delete', [ProductController::class, 'deleteImage'])->name('product.image.delete');

        Route::resource('/subscribers', SubscriberController::class);
        Route::delete('subscribersDeleteAll', [SubscriberController::class,'deleteAll'])->name('subscribers.deleteAll');
        Route::post('send-subscriber-email', [SubscriberController::class,'sendSubscriberEmail'])->name('sendSubscriberEmail');

        Route::get('/financial_transactions', [FinancialTransactionController::class,'index'])->name('financial_transactions.index');

        Route::get('generate-financial-pdf', [FinancialTransactionController::class,'financialpdfview'])->name('generate-financial-pdf');


        Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');
        Route::post('/referrals/store', [ReferralController::class, 'store'])->name('referrals.store');
        Route::post('/referrals/add-points', [ReferralController::class, 'addPoints'])->name('referrals.add-points');
      
        Route::get('/transactions', TransactionController::class)->name('transactions.index');


        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales/{period}', [ReportController::class, 'getSales'])->name('reports.sales');
        Route::get('/reports/vendors/{period}', [ReportController::class, 'getVendors'])->name('reports.vendors');
        Route::get('/reports/brands/{period}', [ReportController::class, 'getBrands'])->name('reports.brands');
        Route::get('/reports/users/{period}', [ReportController::class, 'getUsers'])->name('reports.users');
        Route::get('/reports/products/{period}', [ReportController::class, 'getProducts'])->name('reports.products');
        Route::get('/reports/stores/{period}', [ReportController::class, 'getStores'])->name('reports.stores');



        Route::get('/wallet', [WalletController::class, 'show']); // عرض المحفظة
        Route::post('/wallet/deposit', [WalletController::class, 'deposit']); // إضافة أموال
        Route::post('/wallet/withdraw', [WalletController::class, 'withdraw']); // سحب أموال

    });
});