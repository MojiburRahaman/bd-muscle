 <?php

    use App\Http\Controllers\BrandController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\ProductController;
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

    Route::get('/', function () {
        return view('welcome');
    });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');


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
