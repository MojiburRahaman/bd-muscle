 <?php

    use App\Http\Controllers\BrandController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductViewController;
    use App\Http\Controllers\SizeController;
    use App\Http\Controllers\SubCatagoryController;

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

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');

    // frontend route start
    Route::get('/', [FrontendController::class, 'Frontendhome'])->name('Frontendhome');
    Route::get('/product/{slug}', [ProductViewController::class, 'SingleProductView'])->name('SingleProductView');
    Route::post('/product/get-size', [ProductViewController::class, 'GetSizeByColor'])->name('GetSizeByColor');
    Route::post('/product/get-pricebysize', [ProductViewController::class, 'GetPriceBySize'])->name('GetPriceBySize');
    Route::get('/shop', [FrontendController::class, 'Frontendshop'])->name('Frontendshop');
    // frontend route end


    // backend route start

    // dashboard route 
    Route::resource('dashboard', DashboardController::class);

    // catagory route 
    Route::post('/catagory/mark-delete', [CatagoryController::class, 'MarkdeleteCatagory'])->name('MarkdeleteCatagory');
    Route::resource('/catagory', CatagoryController::class);

    // subcatagory route
    Route::post('/sub-catagory/mark-delete', [SubCatagoryController::class, 'MarkdeleteSubCatagory'])->name('MarkdeleteSubCatagory');
    Route::resource('/subcatagory', SubCatagoryController::class);

    // product route

    Route::get('/product/status/{id}', [ProductController::class, 'ProductStaus'])->name('ProductStaus');
    Route::post('/product/mark-delete/', [ProductController::class, 'MarkdeleteProduct'])->name('MarkdeleteProduct');
    Route::get('/product/edit/product-attribute-delete/{id}', [ProductController::class, 'ProducvtAtributeDelete'])->name('ProducvtAtributeDelete');
    Route::get('/product/edit/product-flavour-delete/{id}', [ProductController::class, 'ProductFlavourDelete'])->name('ProductFlavourDelete');
    Route::get('/product/edit/product-image-delete/{id}', [ProductController::class, 'ProductImagesDelete'])->name('ProductImagesDelete');
    Route::get('/product/get-sub-cat/{cat_id}', [ProductController::class, 'GetSubcatbyAjax'])->name('GetSubcatbyAjax');
    Route::resource('/product', ProductController::class);

    // brand route 
    Route::post('/brand/mark-delete', [BrandController::class, 'Markdeletebrand'])->name('Markdeletebrand');
    Route::resource('/brand', BrandController::class);
    // color route
    Route::resource('/color', ColorController::class);
    // size route 
    Route::resource('/size', SizeController::class);
    // flavour route
    Route::resource('/flavour', FlavourController::class);


















    // backend route start

    require __DIR__ . '/auth.php';
