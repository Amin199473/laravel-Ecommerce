<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\frontend\PagesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalesDateController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\CheckOutController;
use App\Http\Controllers\frontend\ThankYouController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\frontend\UserProfileController;
use App\Http\Controllers\frontend\SaveForLaterController;
use App\Http\Controllers\frontend\ReviewAndRatingController;
use App\Http\Controllers\Admin\PagesController as AdminPages;
use App\Http\Controllers\Admin\ContactController as contactAdmin;
use App\Http\Controllers\Admin\NotificationController;


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

/*ralated routes to Admin panel*/
///////////////////////////////////////////////////////////////

Route::group(['middleware' => 'firewall.all'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'role:super-admin|admin|post-editor|product-manager'])->name('admin');
    //Post Route
    Route::prefix('/admin')->middleware(['auth', 'role:super-admin|admin|post-editor|product-manager'])->group(function () {
        Route::resource('post', PostController::class)->middleware('role:super-admin|admin|post-editor');
        Route::resource('category', CategoryController::class)->middleware('role:super-admin|admin|post-editor|product-manager');
        Route::resource('user', UserController::class)->middleware('role:super-admin|admin');
        Route::resource('role', RoleController::class)->middleware('role:super-admin');
        Route::resource('brand', BrandController::class)->middleware('role:super-admin|admin|product-manager');
        Route::resource('product', ProductsController::class)->middleware('role:super-admin|admin|product-manager');
        Route::put('featured/{id}', [ProductsController::class, 'featured'])->middleware('role:super-admin|admin|product-manager');
        Route::resource('option', OptionController::class)->middleware('role:super-admin|admin|product-manager');
        Route::resource('coupon', CouponController::class)->middleware('role:super-admin|admin|product-manager');
        Route::resource('slider', SliderController::class)->middleware('role:super-admin|admin');
        Route::resource('order', OrderController::class)->middleware('role:super-admin|admin|product-manager');
        Route::resource('testimonials', TestimonialsController::class)->middleware('role:super-admin|admin');
        Route::resource('comment', CommentController::class)->middleware('role:super-admin|admin|post-editor')->except('show');
        Route::get('showComment/{id}', [CommentController::class, 'show'])->middleware('role:super-admin|admin|post-editor')->name('showComment');
        Route::put('approveComment/{id}', [CommentController::class, 'approve'])->middleware('role:super-admin|admin|post-editor')->name('approveComment');
        Route::delete('comment/{id}/delete', [CommentController::class, 'destroy'])->middleware('role:super-admin|admin|post-editor')->name('comment.delete');
        Route::get('contact', [contactAdmin::class, 'index'])->middleware('role:super-admin|admin')->name('contact.index');
        Route::get('showContact/{id}', [contactAdmin::class, 'show'])->middleware('role:super-admin|admin')->name('showContact');



        Route::post('post-deleteAll', [PostController::class, "deleteAll"])->middleware('role:super-admin|admin|post-editor')->name('post.deleteAll');
        Route::post('category-deleteAll', [CategoryController::class, "deleteAll"])->name('category.deleteAll');
        Route::post('user-deleteAll', [UserController::class, "deleteAll"])->middleware('role:super-admin|admin')->name('user.deleteAll');
        Route::post('brand-deleteAll', [BrandController::class, "deleteAll"])->middleware('role:super-admin|admin|product-manager')->name('brand.deleteAll');
        Route::post('product-deleteAll', [ProductsController::class, "deleteAll"])->middleware('role:super-admin|admin|product-manager')->name('product.deleteAll');
        Route::post('option-deleteAll', [OptionController::class, "deleteAll"])->middleware('role:super-admin|admin|product-manager')->name('option.deleteAll');
        Route::post('coupon-deleteAll', [CouponController::class, "deleteAll"])->middleware('role:super-admin|admin|product-manager')->name('coupon.deleteAll');
        Route::post('slider-deleteAll', [SliderController::class, "deleteAll"])->middleware('role:super-admin|admin')->name('slider.deleteAll');
        Route::post('comment-deleteAll', [CommentController::class, "deleteAll"])->middleware('role:super-admin|admin|post-editor')->name('comment.deleteAll');
        Route::post('testimonials-deleteAll', [TestimonialsController::class, "deleteAll"])->middleware('role:super-admin|admin')->name('testimonial.deleteAll');
        Route::post('order-deleteAll', [OrderController::class, "deleteAll"])->middleware('role:super-admin|admin|product-manager')->name('slider.deleteAll');
        Route::post('contact-deleteAll', [contactAdmin::class, "deleteAll"])->middleware('role:super-admin|admin')->name('contact.deleteAll');
        //salesDate Route
        Route::get('/salesDate', [SalesDateController::class, 'index'])->middleware('role:super-admin|admin|product-manager')->name('salesDate');
        Route::post('/salesDate/store', [SalesDateController::class, 'store'])->middleware('role:super-admin|admin|product-manager')->name('salesDate.store');

        //Setting route
        Route::get('/setting', [SettingController::class, 'index'])->middleware('role:super-admin|admin')->name('setting');
        Route::post('/setting/store', [SettingController::class, 'settingStore'])->middleware('role:super-admin|admin')->name('setting.store');
        //Aboute Us Route
        Route::get('/about-us', [AdminPages::class, 'aboutUs'])->middleware('role:super-admin|admin')->name('admin.aboutUs');
        Route::post('/about-us/store', [AdminPages::class, 'aboutUsStore'])->middleware('role:super-admin|admin')->name('admin.about-us.store');

        //Privacy & Policy Route
        Route::get('/privacy-policy', [AdminPages::class, 'privacyPolicy'])->middleware('role:super-admin|admin')->name('admin.privacyPolicy');
        Route::post('/privacy-policy/store', [AdminPages::class, 'privacyPolicyStore'])->middleware('role:super-admin|admin')->name('admin.privacyPolicy.store');

        //file-manager routes
        Route::get('file-manager', function () {
            return view('file');
        })->name('fileManager');


        //notification Routes
        Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('notification-deleteAll', [NotificationController::class, 'deleteAll'])->name('notification.deleteAll');
        Route::post('notification-deleteReaded', [NotificationController::class, 'deleteReaded'])->name('notification.deleteReaded');
        Route::put('markAsRead/{type}', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
        Route::delete('notification-delete/{id}', [NotificationController::class, 'destroy'],)->name('notification.delete');
    });




    /*ralated routes to Frontend page and user*/
    ///////////////////////////////////////////////////////////////
    //route for main page the frontend
    Route::get('/', [HomeController::class, "index"])->name('welcome');
    Route::get('/category/{id}/{category}', [HomeController::class, "category"])->name('category');
    Route::get('/brand/{id}/{brand}', [HomeController::class, "brand"])->name('brand');
    Route::get('/filterByPrice', [HomeController::class, 'filterByPrice'])->name('filterByPrice');
    Route::get('/onSales', [HomeController::class, "onSales"])->name('onSales');
    Route::get('products', [HomeController::class, "products"])->name('products.index');
    Route::get('product/{id}/{slug}', [HomeController::class, "show"])->name('product.singleShow');

    //Cart Routes
    Route::get('cart', [CartController::class, "index"])->name('cart.index');
    Route::post('/cart/store', [CartController::class, "store"])->name('cart.store');
    Route::patch('cart/{id}', [CartController::class, "update"])->name('cart.update');
    Route::delete('/removeFromCart/{product}', [CartController::class, "destroy"])->name('cart.destroy');
    Route::post('cart/switchToSaveForLater/{product}', [CartController::class, "switchToSaveForLater"])->name('cart.switchToSaveForLater');
    Route::delete('/saveForLater/{product}', [SaveForLaterController::class, "destroy"])->name('saveForLater.destroy');
    Route::post('/saveForLater/switchToCart/{product}', [SaveForLaterController::class, "switchToCart"])->name('saveForLater.switchToCart');

    Route::get('/checkout', [CheckOutController::class, "index"])->name('checkout.index');
    Route::post('/checkout/store', [CheckOutController::class, "store"])->name('checkout.store');

    Route::post('/addCoupon', [CheckOutController::class, "addCoupon"])->name('addCoupon');
    Route::post('/removeCoupon', [CheckOutController::class, "removeCoupon"])->name('removeCoupon');
    Route::get('/thank-you', [ThankYouController::class, "index"])->name('thankyou');

    //searches
    Route::get('/searchProduct', [SearchController::class, "searchProduct"])->name('searchProduct');
    Route::get('/searchPost', [SearchController::class, "searchPost"])->name('searchPost');


    //blog routes
    Route::get('/allPosts', [BlogController::class, 'index'])->name('allPosts');
    Route::get('/singlePost/{id}/{slug}', [BlogController::class, 'show'])->name('singlePost');
    Route::get('/categoryPosts/{id}', [BlogController::class, 'categoryPosts'])->name('categoryPosts');
    Route::get('/tagPosts/{id}', [BlogController::class, 'tagPosts'])->name('tagPosts');


    //User Profile Route
    Route::prefix('/user/profile')->middleware('auth')->group(function () {
        Route::get('', [UserProfileController::class, 'index'])->name('userProfile');
        Route::post('/update/{id}', [UserProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::post('/updateAddress/{id}', [UserProfileController::class, 'updateAddressProfile'])->name('updateAddressProfile');
    });


    //wishlist Route
    Route::post('/addToWishlist', [WishlistController::class, 'addToWishlist'])->middleware('auth')->name('addToWishlist');
    Route::post('/removeFromWishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->middleware('auth')->name('removeFromWishlist');

    //Review Route
    Route::post('/addReview/{order_item_id}', [ReviewAndRatingController::class, 'addReview'])->middleware('auth')->name('addReview');

    //Contact Route
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contactUs');
    Route::post('/contact-us/store', [ContactController::class, 'store'])->name('contactUs.store');

    //Pages Route
    Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/privacyPolicy', [PagesController::class, 'privacyPolicy'])->name('privacyPolicy');

    Auth::routes(['verify' => true]);
    // Auth::routes();
    Route::get('verify', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/updateOrderStatus/{id}', [OrderController::class, "updateOrderStatus"])->name('updateOrderStatus');
});