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
    Route::get('/homepage', [AdminController::class, 'homepage'])->name('adminhome.page');
    Route::post('/loginadmin', [AdminController::class, 'loginadmin'])->name('loginadmin');
    // Thêm các route khác ở đây nếu cần
});
