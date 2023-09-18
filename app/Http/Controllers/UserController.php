<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Spend;
use App\Models\Product_coupon;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Category_coupon;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage(Request $request)
    {
        $user = Auth::user();
        $listcategory = Category::all('imagecategory');


        return view('user/page/Homepage', compact('user','listcategory'));

    }
}
