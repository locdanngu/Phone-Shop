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

class CouponController extends Controller
{
    public function listcouponpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 5;
        $coupon = new Coupon();
        $searchcoupon = $request['searchcoupon'];
        
        if ($searchcoupon) {
            $coupon = $coupon->where('endtime', '>', Carbon::now())
                             ->where('code', 'like', '%' . $searchcoupon . '%')
                             ->where('isdelete', 0);
        }
        $countcoupon = $coupon->where('isdelete', 0)->count();

        $coupon = $coupon->where('isdelete', 0)->paginate($limit);
        $category = Category::all();
        $product = Product::orderBy('idcategory')->get();

        return view('admin/page/Listcouponpage', compact('admin','coupon','category','product','countcoupon'));
    }

    public function searchuser(Request $request)
    {
        $user = User::where('iduser', $request['searchuser'])
                  ->orWhere('username', $request['searchuser']) 
                  ->orWhere('email', $request['searchuser']) 
                  ->orWhere('phone', $request['searchuser']) 
                  ->first();
        if($user){
            return response()->json([
                're' => 'yes',
                'iduser' => $user->iduser,
            ]);
        }else{
            return response()->json([
                're' => 'no',
                'iduser' => '',
            ]);
        }
    }

    public function addcoupon(Request $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request['code'];
        $coupon->applicable_to = $request['applicable_to'];
        $coupon->starttime = $request['starttime'];
        $coupon->endtime = $request['endtime'];
        $coupon->iduser = $request['sendiduser'];

        //0 là tất cả  , 1 là danh sách sp , 2 là danh sách cate 
        if($coupon->applicable_to == "product"){
            if($request['product_list_or_cate_list'] == 1){
                $coupon->product_list = 1;
            }elseif($request['product_list_or_cate_list'] == 2){
                $coupon->product_list = 2;
            }elseif($request['product_list_or_cate_list'] == 3){
                $coupon->product_list = 0;
            }
        }else{
            $coupon->product_list = 0;
        }

        $coupon->discount_type = $request['discount_type'];
        $coupon->minimum_order_amount = $request['minimum_order_amount'];
        $coupon->max_discount_amount = $request['max_discount_amount'];
        $coupon->discount_amount = $request['discount_amount'];
        $coupon->used = 0;
        $coupon->isdelete = 0;
        $coupon->save();

        if($coupon->product_list == 1){
            $listPro = explode(',', $request['listproduct']);
            foreach ($listPro as $idproduct) {
                $product_coupon = new Product_coupon();
                $product_coupon->idproduct = $idproduct;
                $product_coupon->idcoupon = $coupon->idcoupon;
                $product_coupon->save();
            }
        }

        if($coupon->product_list == 2){
            $listCate = explode(',', $request['listcate']);
            foreach ($listCate as $idcate) {
                $category_coupon = new Category_coupon();
                $category_coupon->idcategory = $idcate;
                $category_coupon->idcoupon = $coupon->idcoupon;
                $category_coupon->save();
            }
        }
        
        return redirect()->route('listcoupon.page');
    }

    public function checkcode(Request $request)
    {
        $coupon = Coupon::where('code', $request['searchcode'])->first();
        if($coupon){
            return response()->json([
                're' => 'no',
            ]);
        }else{
            return response()->json([
                're' => 'yes',
            ]);
        }
    }

    public function changecoupon(Request $request)
    {
        $coupon = Coupon::where('idcoupon', $request['idcoupon'])->first();
        $coupon->applicable_to = $request['applicable_to'];
        $coupon->starttime = $request['starttime'];
        $coupon->endtime = $request['endtime'];
        $coupon->iduser = $request['sendiduser'];

        if($coupon->applicable_to == "product"){
            if($request['product_list_or_cate_list'] == 1){
                $coupon->product_list = 1;
            }elseif($request['product_list_or_cate_list'] == 2){
                $coupon->product_list = 2;
            }elseif($request['product_list_or_cate_list'] == 3){
                $coupon->product_list = 0;
            }
        }else{
            $coupon->product_list = 0;
        }

        $coupon->discount_type = $request['discount_type'];
        $coupon->minimum_order_amount = $request['minimum_order_amount'];
        $coupon->max_discount_amount = $request['max_discount_amount'];
        $coupon->discount_amount = $request['discount_amount'];
        $coupon->used = 0;
        $coupon->isdelete = 0;
        $coupon->save();

        $deleteproduct = Product_coupon::where('idcoupon', $request['idcoupon'])->delete();
        $deletecategory = Category_coupon::where('idcoupon', $request['idcoupon'])->delete();

        if($coupon->product_list == 1){
            $listPro = explode(',', $request['listproduct']);
            foreach ($listPro as $idproduct) {
                $product_coupon = new Product_coupon();
                $product_coupon->idproduct = $idproduct;
                $product_coupon->idcoupon = $coupon->idcoupon;
                $product_coupon->save();
            }
        }

        if($coupon->product_list == 2){
            $listCate = explode(',', $request['listcate']);
            foreach ($listCate as $idcate) {
                $category_coupon = new Category_coupon();
                $category_coupon->idcategory = $idcate;
                $category_coupon->idcoupon = $coupon->idcoupon;
                $category_coupon->save();
            }
        }
        
        return redirect()->back();
    }

    public function categorylist(Request $request)
    {
        $category = Category::all();
        $html = ''; // Khởi tạo biến chuỗi HTML

        $listcate = Category_coupon::where('idcoupon', $request['idcoupon'])->pluck('idcategory')->toArray();
        
        foreach($category as $ca){
            $isChecked = in_array($ca->idcategory, $listcate) ? 'checked' : ''; // Kiểm tra xem idcategory có trong danh sách $listcate hay không

            $html .= '<label class="d-flex flex-column align-items-center">';
            $html .= '<img src="' . $ca->imagecategory . '" alt="" height="50" style="width:fit-content">';
            $html .= $ca->namecategory;
            $html .= '<input type="checkbox" name="listcate" value="' . $ca->idcategory . '" class="listcate-checkbox" ' . $isChecked . '>';
            $html .= '</label>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }

    public function productlist(Request $request)
    {
        $product = Product::all();
        $html = ''; // Khởi tạo biến chuỗi HTML

        $listproduct = Product_coupon::where('idcoupon', $request['idcoupon'])->pluck('idproduct')->toArray();
        
        foreach($product as $pr){
            $isChecked = in_array($pr->idproduct, $listproduct) ? 'checked' : ''; // Kiểm tra xem idproduct có trong danh sách $listcate hay không

            $html .= '<tr>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->nameproduct . '</td>';
            $html .= '<td class="text-center"><img src="' . $pr->imageproduct . '" alt="" height="50"></td>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->price . ' $</td>';
            $html .= '<td class="font-weight-bold">' . $pr->category->namecategory . '</td>';
            $html .= '<td><input type="checkbox" name="listproduct" value="' . $pr->idproduct . '" class="listproduct-checkbox" ' . $isChecked . '></td>';
            $html .= '</tr>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }

    public function productcount(Request $request)
    {
        $html = Product_coupon::where('idcoupon', $request['id'])->count();
        $listproduct = Product_coupon::where('idcoupon', $request['id'])->pluck('idproduct')->toArray();
        $product = implode(',', $listproduct);

        return response()->json([
            'html' => $html,
            'product' => $product,
        ]);
    }

    public function categorycount(Request $request)
    {
        $html = Category_coupon::where('idcoupon', $request['id'])->count();
        $listcate = Category_coupon::where('idcoupon', $request['id'])->pluck('idcategory')->toArray();
        $category = implode(',', $listcate);

        return response()->json([
            'html' => $html,
            'category' => $category,
        ]);
    }

    public function deletecoupon(Request $request)
    {
        $coupon = Coupon::where('idcoupon', $request['idcoupon'])->first();
        $coupon->isdelete = 1;
        $coupon->save();

        return redirect()->route('listcoupon.page');    
    }

    public function in4categorylist(Request $request)
    {
        $html = ''; 

        $listcate = Category_coupon::where('idcoupon', $request['idcoupon'])->get();
        
        foreach($listcate as $ca){
            $html .= '<label class="d-flex flex-column align-items-center">';
            $html .= '<img src="' . $ca->category->imagecategory . '" alt="" height="50" style="width:fit-content">';
            $html .= $ca->category->namecategory;
            $html .= '</label>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }

    public function in4productlist(Request $request)
    {
        $html = ''; 
        $listproduct = Product_coupon::where('idcoupon', $request['idcoupon'])->get();
    
        foreach($listproduct as $pr){
            $html .= '<tr>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->nameproduct . '</td>';
            $html .= '<td class="text-center"><img src="' . $pr->imageproduct . '" alt="" height="50"></td>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->price . ' $</td>';
            $html .= '<td class="font-weight-bold">' . $pr->category->namecategory . '</td>';
            $html .= '</tr>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }

}