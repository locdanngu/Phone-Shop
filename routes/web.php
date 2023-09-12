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
    Route::get('/loginpage', [AdminController::class, 'loginpage'])->name('adminlogin.page');
    Route::post('/loginadmin', [AdminController::class, 'loginadmin'])->name('loginadmin');

    // Middleware group cho admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/homepage', [AdminController::class, 'homepage'])->name('adminhome.page');
        Route::post('/logoutadmin', [AdminController::class, 'logoutadmin'])->name('logoutadmin');
        Route::get('/changepasswordpage', [AdminController::class, 'changepasswordpage'])->name('adminchangepassword.page');
        Route::post('/changepassword', [AdminController::class, 'changepassword'])->name('adminchangepassword');
        Route::get('/listproductpage', [AdminController::class, 'listproductpage'])->name('listproduct.page');
        Route::get('/listproductpage/search', [AdminController::class, 'listproductpage'])->name('searchproduct');
        Route::post('/addproduct', [AdminController::class, 'addproduct'])->name('product.add');
        Route::post('/changeproduct', [AdminController::class, 'changeproduct'])->name('product.change');
        Route::post('/deleteproduct', [AdminController::class, 'deleteproduct'])->name('product.delete');

        Route::get('/listcategorypage', [AdminController::class, 'listcategorypage'])->name('listcategory.page');
        Route::get('/listcategorypage/search', [AdminController::class, 'listcategorypage'])->name('searchcategory');
        Route::post('/addcategory', [AdminController::class, 'addcategory'])->name('category.add');
        Route::post('/changecategory', [AdminController::class, 'changecategory'])->name('category.change');
        Route::post('/deletecategory', [AdminController::class, 'deletecategory'])->name('category.delete');
    });
});

