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
use App\Models\Type;
use App\Models\Order_product;
use App\Models\Category_coupon;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listproductpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 4;
        $product = new Product();
        $searchproduct = $request['searchproduct'];
        if ($searchproduct) {
            $product = $product->where('nameproduct', 'like', '%' . $searchproduct . '%')
                ->orWhereHas('category', function($query) use ($searchproduct) {
                    $query->where('namecategory', 'like', '%' . $searchproduct . '%');
                })
                ->orderBy('idproduct', 'desc');
        }
        $countproduct = $product->count();

        $product = $product->orderBy('idproduct', 'desc')->paginate($limit);
        $category = Category::all();

        return view('admin/page/Listproductpage', compact('admin','product','searchproduct','category','countproduct'));
    }

    public function addproduct(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $product = new Product();

        $product->nameproduct = $request['nameproduct'];
        $product->oldprice = $request['oldprice'];
        $product->price = $request['price'];
        $product->detail = $request['detail'];
        $product->idcategory = $request['idcategory'];
        $product->sold = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image/product/');
            $image->move($path, $filename);
            $product->imageproduct = '/image/product/' . $filename;
        }
        $product->save();

        $category = Category::where('idcategory', $request['idcategory'])->first();
        $category->product_count += 1;
        $category->save();

        return redirect()->route('listproduct.page');
    }

    public function changeproduct(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $product = Product::where('idproduct', $request['idproduct'])->first();

        $product->nameproduct = $request['nameproduct'];
        $product->oldprice = $request['oldprice'];
        $product->price = $request['price'];
        $product->detail = $request['detail'];

        $category = Category::where('idcategory', $product->idcategory)->first();
        $category->product_count =  $category->product_count - 1;
        
        $category->save();
        $category2 = Category::where('idcategory', $request['idcategory'])->first();
        $category2->product_count =  $category2->product_count + 1;
        $category2->save();

        $product->idcategory = $request['idcategory'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image/product/');
            $image->move($path, $filename);
            $product->imageproduct = '/image/product/' . $filename;
        }
        $product->save();

        return redirect()->route('listproduct.page');
    }

    public function deleteproduct(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $product = Product::where('idproduct', $request['idproduct'])->first();
        $product->delete();
        
        $category = Category::where('idcategory', $request['idcategory'])->first();

        $category->product_count = $category->product_count - 1;
        $category->save();

        return redirect()->route('listproduct.page');
    }


}