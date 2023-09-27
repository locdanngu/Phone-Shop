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
use App\Models\Notificationemail;
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
                ->orWhereHas('type', function($query) use ($searchproduct) {
                    $query->where('nametype', 'like', '%' . $searchproduct . '%');
                })
                ->orderBy('idproduct', 'desc');
        }
        $countproduct = $product->count();

        $product = $product->orderBy('idproduct', 'desc')->paginate($limit);
        $category = Category::all();
        $type = Type::all();

        return view('admin/page/Listproductpage', compact('admin','product','searchproduct','category','countproduct','type'));
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
        $product->idtype = $request['idtype'];
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

        $type = Type::where('idtype', $request['idtype'])->first();
        $type->product_count += 1;
        $type->save();

        $allemail = Notificationemail::all();

        $price = $product->price;
        $nameproduct = $product->nameproduct;
        $category = $product->category->namecategory;
        $image = $product->imageproduct;

        foreach ($allemail as $emailAddress) {
            try {
                $result = Mail::send('admin/page/Thongbaosanphammoi', compact('nameproduct', 'category','price','image'), function ($email) use ($image,$nameproduct, $category, $emailAddress, $price) {
                    $email->subject('Thông báo về sản phẩm mới: ' . $nameproduct);
                    $email->to($emailAddress->email);
                });
            } catch (\Exception $e) {
                continue; 
            }
        }




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

        $type = Type::where('idtype', $product->idtype)->first();
        $type->product_count =  $type->product_count - 1;
        
        $type->save();
        $type2 = Type::where('idtype', $request['idtype'])->first();
        $type2->product_count =  $type2->product_count + 1;
        $type2->save();

        $product->idtype = $request['idtype'];

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

        $type = Type::where('idtype', $product->idtype)->first();
        $type->product_count = $type->product_count - 1;
        $type->save();

        $product->delete();
        
        $category = Category::where('idcategory', $request['idcategory'])->first();

        $category->product_count = $category->product_count - 1;
        $category->save();

        

        return redirect()->route('listproduct.page');
    }


}