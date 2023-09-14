<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function () {
    //Loginadmin
    Route::get('/loginpage', [AdminController::class, 'loginpage'])->name('adminlogin.page');
    Route::post('/loginadmin', [AdminController::class, 'loginadmin'])->name('loginadmin');

    // Middleware group cho admin
    Route::middleware(['admin'])->group(function () {
        //Admin
        Route::get('/homepage', [AdminController::class, 'homepage'])->name('adminhome.page');
        Route::post('/logoutadmin', [AdminController::class, 'logoutadmin'])->name('logoutadmin');
        Route::get('/changepasswordpage', [AdminController::class, 'changepasswordpage'])->name('adminchangepassword.page');
        Route::post('/changepassword', [AdminController::class, 'changepassword'])->name('adminchangepassword');

        //Product
        Route::get('/listproductpage', [AdminController::class, 'listproductpage'])->name('listproduct.page');
        Route::get('/listproductpage/search', [AdminController::class, 'listproductpage'])->name('searchproduct');
        Route::post('/addproduct', [AdminController::class, 'addproduct'])->name('product.add');
        Route::post('/changeproduct', [AdminController::class, 'changeproduct'])->name('product.change');
        Route::post('/deleteproduct', [AdminController::class, 'deleteproduct'])->name('product.delete');

        //Category
        Route::get('/listcategorypage', [AdminController::class, 'listcategorypage'])->name('listcategory.page');
        Route::get('/listcategorypage/search', [AdminController::class, 'listcategorypage'])->name('searchcategory');
        Route::post('/addcategory', [AdminController::class, 'addcategory'])->name('category.add');
        Route::post('/changecategory', [AdminController::class, 'changecategory'])->name('category.change');
        Route::post('/deletecategory', [AdminController::class, 'deletecategory'])->name('category.delete');

        //Coupon
        Route::get('/listcouponpage', [AdminController::class, 'listcouponpage'])->name('listcoupon.page');
        Route::post('/searchuser', [AdminController::class, 'searchuser'])->name('user.search');
        Route::post('/checkcode', [AdminController::class, 'checkcode'])->name('code.check');
        Route::post('/addcoupon', [AdminController::class, 'addcoupon'])->name('coupon.add');
        Route::post('/changecoupon', [AdminController::class, 'changecoupon'])->name('coupon.change');
        Route::post('/categorylist', [AdminController::class, 'categorylist'])->name('cate.list');
        Route::post('/productlist', [AdminController::class, 'productlist'])->name('product.list');
        Route::post('/categorycount', [AdminController::class, 'categorycount'])->name('cate.count');
        Route::post('/productcount', [AdminController::class, 'productcount'])->name('product.count');
        Route::get('/listcouponpage/search', [AdminController::class, 'listcouponpage'])->name('searchcoupon');
    });
});

