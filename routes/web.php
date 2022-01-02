 <?php

use App\Http\Controllers\BestDealController;
use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductViewController;
    use App\Http\Controllers\SearchController;
    use App\Http\Controllers\SizeController;
    use App\Http\Controllers\SubCatagoryController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\BlogController;
    use App\Http\Controllers\UserProfileController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\Controllers\OrderController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SocialLoginController;
    use Illuminate\Support\Facades\Auth;
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
    // socialite

    Route::get('login/google', [SocialLoginController::class, 'GoogleLogin'])->name('GoogleLogin');
    Route::get('register/google', [SocialLoginController::class, 'GoogleRegister'])->name('GoogleRegister');
    Route::get('login/callback', [SocialLoginController::class, 'GoogleCallbackUrlRegister'])->name('GoogleCallbackUrlRegister');


    Auth::routes(['verify' => true]);

    // socialite
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');

    // frontend route start
    Route::get('/', [FrontendController::class, 'Frontendhome'])->name('Frontendhome');
    Route::post('/newsletter', [FrontendController::class, 'FrontenNewsLetter'])->name('FrontenNewsLetter');
    // Route::get('/search', [FrontendController::class, 'FrontendSearch'])->name('FrontendSearch');
    Route::get('/product/{slug}', [ProductViewController::class, 'SingleProductView'])->name('SingleProductView');
    Route::post('/product/get-size', [ProductViewController::class, 'GetSizeByColor'])->name('GetSizeByColor');
    Route::post('/product/get-pricebysize', [ProductViewController::class, 'GetPriceBySize'])->name('GetPriceBySize');
    Route::get('/shop', [FrontendController::class, 'Frontendshop'])->name('Frontendshop');

    // blog route
    Route::get('/blog', [FrontendController::class, 'Frontendblog'])->name('Frontendblog');
    Route::get('/blog/{slug}', [FrontendController::class, 'FrontenblogView'])->name('FrontenblogView');
    Route::post('/blog/comment', [FrontendController::class, 'BlogComment'])->name('BlogComment');
    Route::post('/blog/reply', [FrontendController::class, 'BlogReply'])->name('BlogReply');


    // search route start
    Route::get('/product-category/{slug}', [SearchController::class, 'CategorySearch'])->name('CategorySearch');
    // search route end

    // cart route start
    Route::get('/cart', [CartController::class, 'CartView'])->name('CartView');
    Route::get('/cart/{coupon_name}', [CartController::class, 'CartView']);
    Route::get('/cart/cart-delete/{id}', [CartController::class, 'CartDelete'])->name('CartDelete');
    Route::post('/cart/cart-clear/', [CartController::class, 'CartClear'])->name('CartClear');
    Route::post('/cart/quantity-update', [CartController::class, 'CartUpdate'])->name('CartUpdate');
    Route::post('/cartpost', [CartController::class, 'CartPost'])->name('CartPost');

    // cart route end
    Route::middleware(['auth', 'verified', 'checkcoustomer'])->group(function () {
        // Profile route
        Route::get('/profile', [UserProfileController::class, 'FrontendProfile'])->name('FrontendProfile');
        Route::post('/change-password', [UserProfileController::class, 'ChangeUserPass'])->name('ChangeUserPass');
        // wishlist route start
        Route::get('/wishlist', [WishlistController::class, 'WishlistView'])->name('WishlistView');
        Route::post('/wishlist-post', [WishlistController::class, 'WishlistPost'])->name('WishlistPost');
        Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishlistRemove'])->name('WishlistRemove');
        // wishlist route end

        // checkout route start
        Route::get('/checkout', [CheckoutController::class, 'CheckoutView'])->name('CheckoutView');
        Route::post('/checkout-post', [CheckoutController::class, 'CheckoutPost'])->name('CheckoutPost');

        Route::post('/checkout/billing/division_id', [CheckoutController::class, 'CheckoutajaxDivid'])->name('CheckoutajaxDivid');
        Route::post('/checkout/billing/disctrict_id', [CheckoutController::class, 'CheckoutajaxDistrictid'])->name('CheckoutajaxDistrictid');

        // checkout route end

    });

    // frontend route end


    // backend route start
    Route::middleware(['auth', 'checkadminpanel'])->prefix('admin')->group(function () {
        Route::get('/change-password', [DashboardController::class,'AdminChangePassword'])->name('AdminChangePassword');
        Route::post('/change-password', [DashboardController::class,'AdminChangePasswordPost'])->name('AdminChangePasswordPost');
        Route::resource('dashboard', DashboardController::class);

        // catagory route 
        Route::post('/catagory/mark-delete', [CatagoryController::class, 'MarkdeleteCatagory'])->name('MarkdeleteCatagory');
        Route::resource('/catagory', CatagoryController::class);

        // subcatagory route
        Route::post('/sub-catagory/mark-delete', [SubCatagoryController::class, 'MarkdeleteSubCatagory'])->name('MarkdeleteSubCatagory');
        Route::resource('/subcatagory', SubCatagoryController::class);

        // product route

        // Route::get('/products/best_seller/{id}', [ProductController::class, 'Best_seller'])->name('Best_seller');
        Route::get('/products/status/{id}', [ProductController::class, 'ProductStaus'])->name('ProductStaus');
        Route::post('/products/mark-delete/', [ProductController::class, 'MarkdeleteProduct'])->name('MarkdeleteProduct');
        Route::get('/products/edit/product-attribute-delete/{id}', [ProductController::class, 'ProducvtAtributeDelete'])->name('ProducvtAtributeDelete');
        Route::get('/products/edit/product-flavour-delete/{id}', [ProductController::class, 'ProductFlavourDelete'])->name('ProductFlavourDelete');
        Route::get('/products/edit/product-image-delete/{id}', [ProductController::class, 'ProductImagesDelete'])->name('ProductImagesDelete');
        Route::get('/products/get-sub-cat/{cat_id}', [ProductController::class, 'GetSubcatbyAjax'])->name('GetSubcatbyAjax');
        Route::resource('/products', ProductController::class);

        // brand route 
        Route::post('/brand/mark-delete', [BrandController::class, 'Markdeletebrand'])->name('Markdeletebrand');
        Route::resource('/brand', BrandController::class);

        //    roles route
        Route::get('/roles/add-user', [RoleController::class, 'CreateUser'])->name('CreateUser');
        Route::post('/roles/add-user-post', [RoleController::class, 'CreateUserPost'])->name('CreateUserPost');
        Route::post('/roles/assign-user-post', [RoleController::class, 'AssignUserPost'])->name('AssignUserPost');
        Route::get('/roles/assign-user', [RoleController::class, 'AssignUser'])->name('AssignUser');
        Route::resource('/roles', RoleController::class);
        // order route
        Route::get('orders/status/{id}', [OrderController::class, 'DeliveryStatus'])->name('DeliveryStatus');
        Route::get('orders/download-invoice/{id}', [OrderController::class, 'InvoiceDownload'])->name('InvoiceDownload');
        Route::resource('/orders', OrderController::class);
        
        Route::get('settings/banner-status/{id}', [SiteSettingController::class, 'SiteBannerStatus'])->name('SiteBannerStatus');
        Route::get('settings/banner-delete/{id}', [SiteSettingController::class, 'SiteBannerDelete'])->name('SiteBannerDelete');
        Route::post('settings/banner-post', [SiteSettingController::class, 'SiteBannerPost'])->name('SiteBannerPost');
        Route::get('settings/banner', [SiteSettingController::class, 'SiteBanner'])->name('SiteBanner');
        Route::resource('/settings', SiteSettingController::class);
        // coupon route
        Route::resource('/coupons', CouponController::class);
        // color route
        Route::resource('/color', ColorController::class);
        // size route 
        Route::resource('/size', SizeController::class);
        // flavour route
        Route::resource('/flavour', FlavourController::class);

        Route::resource('/blogs', BlogController::class);
        // best deal controller
        Route::resource('/deals', BestDealController::class)->except('edit',);

    });
















    // backend route start

    require __DIR__ . '/auth.php';

    Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
