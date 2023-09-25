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

class CategoryController extends Controller
{
    public function listcategorypage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 4;
        $category = new Category();
        $searchcategory = $request['searchcategory'];
        if ($searchcategory) {
            $category = $category->where('namecategory', 'like', '%' . $searchcategory . '%')->orderBy('idcategory', 'desc');
        }
        $countcategory = $category->count();
        $category = $category->orderBy('idcategory', 'desc')->paginate($limit);
        return view('admin/page/Listcategorypage', compact('admin','category','searchcategory','countcategory'));
    }

    public function addcategory(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $category = new Category();

        $category->namecategory = $request['namecategory'];
        $category->product_count = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image/category/');
            $image->move($path, $filename);
            $category->imagecategory = '/image/category/' . $filename;
        }
        $category->save();

        return redirect()->route('listcategory.page');
    }

    public function changecategory(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $category = Category::where('idcategory', $request['idcategory'])->first();

        $category->namecategory = $request['namecategory'];
        // $category->product_count = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image/category/');
            $image->move($path, $filename);
            $category->imagecategory = '/image/category/' . $filename;
        }
        $category->save();

        return redirect()->route('listcategory.page');
    }

    public function deletecategory(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $category = Category::where('idcategory', $request['idcategory'])->first();
        $category->delete();
        return redirect()->route('listcategory.page');
    }

}