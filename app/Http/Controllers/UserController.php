<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Type;
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
        $lastproduct = Product::orderBy('created_at', 'desc')->take(10)->get();
        $topseller = Product::orderBy('sold', 'desc')->take(3)->get();
        $recently = Product::orderBy('updated_at', 'desc')->take(3)->get();
        $randomproduct = Product::inRandomOrder()->take(4)->get();

        return view('user/page/Homepage', compact('user','listcategory','lastproduct','topseller','recently','randomproduct'));

    }

    public function shoppage(Request $request)
    {
        $user = Auth::user();
        $limit = $request->limit ?? 12;
        $product = new Product();
        $product = $product->paginate($limit);


        return view('user/page/Shoppage', compact('user','product'));

    }

    public function productpage(Request $request)
    {
        $user = Auth::user();
        $product = Product::where('nameproduct', $request['nameproduct'])->first();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(6)->get();

        return view('user/page/Productpage', compact('user','product','list','recent','random'));
    }

    public function cartpage(Request $request)
    {
        $user = Auth::user();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(2)->get();

        return view('user/page/Cartpage', compact('user','list','recent','random'));
    }

    public function checkoutpage(Request $request)
    {
        $user = Auth::user();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(2)->get();

        return view('user/page/Checkoutpage', compact('user','list','recent','random'));
    }
}

