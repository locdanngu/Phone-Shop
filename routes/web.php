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
        Route::get('/', [AdminController::class, 'listproductpage'])->name('searchproduct');
    });
});
