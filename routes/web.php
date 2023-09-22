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
    Route::get('/shoppage', [UserController::class, 'shoppage'])->name('shop.page');
    Route::get('/shoppage/search', [UserController::class, 'shoppage'])->name('shop.search');
    Route::get('/productpage', [UserController::class, 'productpage'])->name('product.page');
    Route::get('/cartpage', [UserController::class, 'cartpage'])->name('cart.page');
    Route::get('/checkoutpage', [UserController::class, 'checkoutpage'])->name('checkout.page');
    Route::get('/checkoutlist', [UserController::class, 'checkoutlist'])->name('checkoutlist.page');

    Route::post('/checkoutpage', [UserController::class, 'addorder'])->name('checkout');
    Route::post('/loginuser', [UserController::class, 'loginuser'])->name('loginuser');
    Route::post('/registeruser', [UserController::class, 'registeruser'])->name('registeruser');
    Route::get('/logoutuser', [UserController::class, 'logoutuser'])->name('logoutuser');
    Route::post('/checkuser', [UserController::class, 'checkusername'])->name('checkuser');
    Route::post('/addcartwithquantity', [UserController::class, 'addcartwithquantity'])->name('addcartwithquantity');
    Route::post('/addcart', [UserController::class, 'addcart'])->name('addcart');
    Route::post('/deleteproductcart', [UserController::class, 'deleteproductcart'])->name('deleteproductcart');
    Route::post('/updateproductcart', [UserController::class, 'updateproductcart'])->name('updateproductcart');
    Route::post('/addreview', [UserController::class, 'addreview'])->name('addreview');
    Route::post('/morereview', [UserController::class, 'morereview'])->name('morereview');
    Route::get('/wishlistpage', [UserController::class, 'wishlistpage'])->name('wishlist.page');
    Route::post('/deleteproductwishlist', [UserController::class, 'deleteproductwishlist'])->name('deleteproductwishlist');
    Route::post('/addwishlist', [UserController::class, 'addwishlist'])->name('addwishlist');
    Route::get('/userpage', [UserController::class, 'userpage'])->name('user.page');
    Route::post('/changenameuser', [UserController::class, 'changenameuser'])->name('changenameuser');
    Route::post('/addaddress', [UserController::class, 'addaddress'])->name('addaddress');
    Route::post('/changepassword', [UserController::class, 'changepassword'])->name('changepassword');
    Route::post('/deletemainaddress', [UserController::class, 'deletemainaddress'])->name('deletemainaddress');
    Route::post('/deleteanotheraddress', [UserController::class, 'deleteanotheraddress'])->name('deleteanotheraddress');
    Route::get('/chuyenhuong', [UserController::class, 'chuyenhuong'])->name('chuyenhuong');
    Route::post('/checkoutpage2', [UserController::class, 'checkoutpage2'])->name('checkout.page2');
    Route::post('/deletecheckout', [UserController::class, 'deletecheckout'])->name('deletecheckout');
    Route::post('/deleteapplycoupon', [UserController::class, 'deleteapplycoupon'])->name('deleteapplycoupon');
    Route::post('/deleteapplycouponcart', [UserController::class, 'deleteapplycouponcart'])->name('deleteapplycouponcart');
    Route::post('/checkcoupon', [UserController::class, 'checkcoupon'])->name('checkcoupon');
    Route::get('/bankpayment', [UserController::class, 'bankpayment'])->name('bankpayment');
    Route::post('/bankpayment', [UserController::class, 'bankpay'])->name('bankpay');


    Route::post('pay', [PaymentController::class, 'pay'])->name('user.pay');
    Route::get('success', [PaymentController::class, 'success'])->name('user.successpay');
    Route::get('error', [PaymentController::class, 'error'])->name('user.errorpay');
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
        Route::get('/listproductpage', [ProductController::class, 'listproductpage'])->name('listproduct.page');
        Route::get('/listproductpage/search', [ProductController::class, 'listproductpage'])->name('searchproduct');
        Route::post('/addproduct', [ProductController::class, 'addproduct'])->name('product.add');
        Route::post('/changeproduct', [ProductController::class, 'changeproduct'])->name('product.change');
        Route::post('/deleteproduct', [ProductController::class, 'deleteproduct'])->name('product.delete');

        //Category
        Route::get('/listcategorypage', [CategoryController::class, 'listcategorypage'])->name('listcategory.page');
        Route::get('/listcategorypage/search', [CategoryController::class, 'listcategorypage'])->name('searchcategory');
        Route::post('/addcategory', [CategoryController::class, 'addcategory'])->name('category.add');
        Route::post('/changecategory', [CategoryController::class, 'changecategory'])->name('category.change');
        Route::post('/deletecategory', [CategoryController::class, 'deletecategory'])->name('category.delete');

        //Type
        Route::get('/listtypepage', [TypeController::class, 'listtypepage'])->name('listtype.page');
        Route::get('/listtypepage/search', [TypeController::class, 'listtypepage'])->name('searchtype');
        Route::post('/addtype', [TypeController::class, 'addtype'])->name('type.add');
        Route::post('/changetype', [TypeController::class, 'changetype'])->name('type.change');
        Route::post('/deletetype', [TypeController::class, 'deletetype'])->name('type.delete');

        //Coupon
        Route::get('/listcouponpage', [CouponController::class, 'listcouponpage'])->name('listcoupon.page');
        Route::post('/searchuser', [CouponController::class, 'searchuser'])->name('user.search');
        Route::post('/checkcode', [CouponController::class, 'checkcode'])->name('code.check');
        Route::post('/addcoupon', [CouponController::class, 'addcoupon'])->name('coupon.add');
        Route::post('/changecoupon', [CouponController::class, 'changecoupon'])->name('coupon.change');
        Route::post('/deletecoupon', [CouponController::class, 'deletecoupon'])->name('coupon.delete');
        Route::post('/categorylist', [CouponController::class, 'categorylist'])->name('cate.list');
        Route::post('/productlist', [CouponController::class, 'productlist'])->name('product.list');
        Route::post('/in4categorylist', [CouponController::class, 'in4categorylist'])->name('in4cate.list');
        Route::post('/in4productlist', [CouponController::class, 'in4productlist'])->name('in4product.list');
        Route::post('/categorycount', [CouponController::class, 'categorycount'])->name('cate.count');
        Route::post('/productcount', [CouponController::class, 'productcount'])->name('product.count');
        Route::get('/listcouponpage/search', [CouponController::class, 'listcouponpage'])->name('searchcoupon');

        //Coupon(hết hạn)
        Route::get('/listexpiredcouponpage', [CouponController::class, 'listexpiredcouponpage'])->name('listexpiredcoupon.page');
        Route::get('/listexpiredcouponpage/search', [CouponController::class, 'listexpiredcouponpage'])->name('searchcouponexpired');

        //Order (chờ xác nhận)
        Route::get('/listorderpage', [OrderController::class, 'listorderpage'])->name('listorder.page');
        Route::get('/listorderpage/search', [OrderController::class, 'listorderpage'])->name('order.search');
        Route::post('/in4order', [OrderController::class, 'in4order'])->name('order.in4');
        Route::post('/successorder', [OrderController::class, 'successorder'])->name('order.success');
        Route::post('/denyorder', [OrderController::class, 'denyorder'])->name('order.deny');
        //Order (giao hàng)
        Route::get('/listordershippage', [OrderController::class, 'listordershippage'])->name('listordership.page');
        Route::get('/listordershippage/search', [OrderController::class, 'listordershippage'])->name('ordership.search');
        Route::post('/doneorder', [OrderController::class, 'doneorder'])->name('order.done');
        //Order (đã hủy)
        Route::get('/listordercancelpage', [OrderController::class, 'listordercancelpage'])->name('listordercancel.page');
        Route::get('/listordercancelpage/search', [OrderController::class, 'listordercancelpage'])->name('ordercancel.search');

        //Revenue(thu nhập)
        Route::get('/listrevenuepage', [RevenueController::class, 'listrevenuepage'])->name('listrevenue.page');
        Route::get('/listrevenuepage/search', [RevenueController::class, 'listrevenuepage'])->name('revenue.search');
        //Revenue(chi tiêu)
        Route::get('/listspendpage', [RevenueController::class, 'listspendpage'])->name('listspend.page');
        Route::get('/listspendpage/search', [RevenueController::class, 'listspendpage'])->name('spend.search');
        Route::post('/spendadd', [RevenueController::class, 'spendadd'])->name('spend.add');
        Route::post('/spendchange', [RevenueController::class, 'spendchange'])->name('spend.change');

        //User
        Route::get('/listuserpage', [AdminController::class, 'listuserpage'])->name('listuser.page');
        Route::get('/listuserpage/search', [AdminController::class, 'listuserpage'])->name('searchuser');
        Route::post('/changepassuser', [AdminController::class, 'changepassuser'])->name('user.changepass');
        Route::post('/changestatususer', [AdminController::class, 'changestatususer'])->name('user.changestatus');

    });
});