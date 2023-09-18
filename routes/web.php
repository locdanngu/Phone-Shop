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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/')->group(function () {
    Route::get('/', [UserController::class, 'homepage'])->name('home.page');

});


Route::prefix('/admin')->group(function () {
    //Loginadmin
    Route::get('/loginpage', [AdminController::class, 'loginpage'])->name('adminlogin.page');
    Route::post('/loginadmin', [AdminController::class, 'loginadmin'])->name('loginadmin');

    // Middleware group cho admin
    Route::middleware(['admin'])->group(function () {
        //Admin(tác vụ)
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
        Route::post('/deletecoupon', [AdminController::class, 'deletecoupon'])->name('coupon.delete');
        Route::post('/categorylist', [AdminController::class, 'categorylist'])->name('cate.list');
        Route::post('/productlist', [AdminController::class, 'productlist'])->name('product.list');
        Route::post('/in4categorylist', [AdminController::class, 'in4categorylist'])->name('in4cate.list');
        Route::post('/in4productlist', [AdminController::class, 'in4productlist'])->name('in4product.list');
        Route::post('/categorycount', [AdminController::class, 'categorycount'])->name('cate.count');
        Route::post('/productcount', [AdminController::class, 'productcount'])->name('product.count');
        Route::get('/listcouponpage/search', [AdminController::class, 'listcouponpage'])->name('searchcoupon');

        //Coupon(hết hạn)
        Route::get('/listexpiredcouponpage', [AdminController::class, 'listexpiredcouponpage'])->name('listexpiredcoupon.page');
        Route::get('/listexpiredcouponpage/search', [AdminController::class, 'listexpiredcouponpage'])->name('searchcouponexpired');


        //Order (chờ xác nhận)
        Route::get('/listorderpage', [AdminController::class, 'listorderpage'])->name('listorder.page');
        Route::get('/listorderpage/search', [AdminController::class, 'listorderpage'])->name('order.search');
        Route::post('/in4order', [AdminController::class, 'in4order'])->name('order.in4');
        Route::post('/successorder', [AdminController::class, 'successorder'])->name('order.success');
        Route::post('/denyorder', [AdminController::class, 'denyorder'])->name('order.deny');
        //Order (giao hàng)
        Route::get('/listordershippage', [AdminController::class, 'listordershippage'])->name('listordership.page');
        Route::get('/listordershippage/search', [AdminController::class, 'listordershippage'])->name('ordership.search');
        Route::post('/doneorder', [AdminController::class, 'doneorder'])->name('order.done');
        //Order (đã hủy)
        Route::get('/listordercancelpage', [AdminController::class, 'listordercancelpage'])->name('listordercancel.page');
        Route::get('/listordercancelpage/search', [AdminController::class, 'listordercancelpage'])->name('ordercancel.search');

        //Revenue(thu nhập)
        Route::get('/listrevenuepage', [AdminController::class, 'listrevenuepage'])->name('listrevenue.page');
        Route::get('/listrevenuepage/search', [AdminController::class, 'listrevenuepage'])->name('revenue.search');
        //Revenue(chi tiêu)
        Route::get('/listspendpage', [AdminController::class, 'listspendpage'])->name('listspend.page');
        Route::get('/listspendpage/search', [AdminController::class, 'listspendpage'])->name('spend.search');
        Route::post('/spendadd', [AdminController::class, 'spendadd'])->name('spend.add');
        Route::post('/spendchange', [AdminController::class, 'spendchange'])->name('spend.change');

        //User
        Route::get('/listuserpage', [AdminController::class, 'listuserpage'])->name('listuser.page');
        Route::get('/listuserpage/search', [AdminController::class, 'listuserpage'])->name('searchuser');
        Route::post('/changepassuser', [AdminController::class, 'changepassuser'])->name('user.changepass');
        Route::post('/changestatususer', [AdminController::class, 'changestatususer'])->name('user.changestatus');

    });
});