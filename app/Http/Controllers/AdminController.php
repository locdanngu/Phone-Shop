<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Product_coupon;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Category_coupon;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginpage(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return redirect()->route('adminhome.page', compact('admin'));
        } else {
            return view('admin/page/Loginpage');
        }
    }

    public function homepage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin/page/Homepage', compact('admin'));
    }

    public function loginadmin(Request $request){
        // $this->validate($request, [
        //     'adminname' => 'required',
        //     'password' => 'required'
        // ]);
        $this->validate($request, ['adminname' => 'required',
                                    'password' => 'required']);
        
        // Lấy thông tin đăng nhập từ đầu vào
        $credentials = $request->only('adminname', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            // Người dùng admin đã được xác thực
            return redirect()->route('adminhome.page');
        } else {
            return redirect()->route('adminlogin.page')->withErrors(['adminname' => 'Sai tên đăng nhập hoặc mật khẩu!!!']);
        }
    }

    public function logoutadmin(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminlogin.page');
    }

    public function changepasswordpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin/page/Changepasswordpage', compact('admin'));
    }

    public function changepassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if (!Hash::check($request['passold'], $admin->password)) {
            return redirect()->back()->withInput()->withErrors(['passold' => 'Mật khẩu bạn nhập vào không khớp']);
        }
        
        if (strlen($request->input('passnew')) < 6) {
            return redirect()->back()->withInput()->withErrors(['passnewshort' => 'Mật khẩu yêu cầu nhiều hơn hoặc bằng 6 kí tự']);
        }
        
        if ($request['passold'] ===  $request['passnew']) {
            return redirect()->back()->withInput()->withErrors(['passnew' => 'Mật khẩu mới không được giống mật khẩu cũ']);
        } 

        if ($request['passnew'] !== $request['passconfirm']) {
            return redirect()->back()->withInput()->withErrors(['passcon' => 'Mật khẩu xác nhận không khớp']);
        } 
        
        $admin->password = Hash::make($request['passnew']);

        $admin->save();
        return redirect()->back()->withInput()->withErrors(['suc' => 'Đổi mật khẩu thành công']);
    }

    public function listproductpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 5;
        $product = new Product();
        $searchproduct = $request['searchproduct'];
        // if ($searchproduct) {
        //     $product = $product->where(function($query) use ($searchproduct) {
        //         $query->where('nameproduct', 'like', '%' . $searchproduct . '%')
        //               ->orWhere('price', 'like', '%' . $searchproduct . '%');
        //     })->orderBy('idproduct', 'desc');
        // }
        if ($searchproduct) {
            $product = $product->where('nameproduct', 'like', '%' . $searchproduct . '%')
                ->orWhereHas('category', function($query) use ($searchproduct) {
                    $query->where('namecategory', 'like', '%' . $searchproduct . '%');
                })
                ->orderBy('idproduct', 'desc');
        }
        
        $product = $product->orderBy('idproduct', 'desc')->paginate($limit);
        $countproduct = $product->count();
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

    public function listcategorypage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 5;
        $category = new Category();
        $searchcategory = $request['searchcategory'];
        if ($searchcategory) {
            $category = $category->where('namecategory', 'like', '%' . $searchcategory . '%')->orderBy('idcategory', 'desc');
        }
        $category = $category->orderBy('idcategory', 'desc')->paginate($limit);
        $countcategory = $category->count();
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

    public function deletecategory(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $category = Category::where('idcategory', $request['idcategory'])->first();
        $category->delete();
        return redirect()->route('listcategory.page');
    }

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
        $coupon = $coupon->where('isdelete', 0)->paginate($limit);
        $category = Category::all();
        $product = Product::orderBy('idcategory')->get();
        $countcoupon = $coupon->count();

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

        if($coupon->applicable_to == "product"){
            if($request['product_list_or_cate_list'] == 1){
                $coupon->product_list = 1;
                $coupon->category_list = 0;
            }elseif($request['product_list_or_cate_list'] == 2){
                $coupon->product_list = 0;
                $coupon->category_list = 0;
            }elseif($request['product_list_or_cate_list'] == 3){
                $coupon->category_list = 1;
                $coupon->product_list = 0;
            }else{
                $coupon->category_list = 0;
                $coupon->product_list = 0;
            }
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

        if($coupon->category_list == 1){
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
                $coupon->category_list = 0;
            }elseif($request['product_list_or_cate_list'] == 2){
                $coupon->product_list = 0;
                $coupon->category_list = 0;
            }elseif($request['product_list_or_cate_list'] == 3){
                $coupon->category_list = 1;
                $coupon->product_list = 0;
            }else{
                $coupon->category_list = 0;
                $coupon->product_list = 0;
            }
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

        

        if($coupon->category_list == 1){
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
        
        foreach($listproduct as $ca){
            $html .= '<label class="d-flex flex-column align-items-center">';
            $html .= '<img src="' . $ca->product->imagecategory . '" alt="" height="50" style="width:fit-content">';
            $html .= $ca->product->namecategory;
            $html .= '</label>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }

    public function listorderpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $order = Order::where('status', 'wait')->get();
        $countorder = $order->count();

        
        if($request->input('year') && $request->input('month') && $request->input('day')){
            $year = $request->input('year');
            $month = $request->input('month');
            $day = $request->input('day');

            if ($request->filled('year')) {
                $order = Order::where('status', 'wait')->whereYear('created_at', $year);
            }
            
            if ($request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereMonth('created_at', $month) : Order::where('status', 'wait')->whereMonth('created_at', $month);
            }
            
            if ($request->filled('day') && $request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereDay('created_at', $day) : Order::where('status', 'wait')->whereDay('created_at', $day);
            }

            if ($request->filled('day') && !$request->filled('month') && !$request->filled('year')) {
                $order = Order::whereDay('created_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::whereMonth('created_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::whereDay('created_at', $day)->whereMonth('created_at', $month);
            }
            
            
            $order = $order->get();
            
            $countorder = $order->count();
        }

        return view('admin/page/Listorderpage', compact('admin','order','countorder'));
    }

    public function in4order(Request $request)
    {
        $productlist = Order_product::where('idorder', $request['id'])->get();
        $id = Order::where('idorder', $request['id'])->first();
        $user = User::where('iduser', $id->iduser)->first();

        $html = '';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Người đặt mua</span>';
        $html .= '<span class="spanpopup font-weight-bold">' . $user->firstname . ' ' . $user->lastname . '</span>';
        $html .= '</div>';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Tài khoản</span>';
        $html .= '<span class="spanpopup font-weight-bold">' . $user->username . '</span>';
        $html .= '</div>';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Email liên hệ</span>';
        $html .= '<span class="spanpopup font-weight-bold">' . $user->email . '</span>';
        $html .= '</div>';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Số điện thoại</span>';
        $html .= '<span class="spanpopup font-weight-bold">' . $user->phone . '</span>';
        $html .= '</div>';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Địa chỉ</span>';
        $html .= '<span class="spanpopup font-weight-bold">' . $user->address . '</span>';
        $html .= '</div>';

        $html .= '<div class="input-group mb-3">';
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Lời nhắn</span>';
        if(!$id->note){
            $html .= '<span class="spanpopup">Trống</span>';
        }else{
            $html .= '<span class="spanpopup">' . $id->note . '</span>';
        }
        $html .= '</div>';

        $html .= '<div class="card-body table-responsive p-0" style="max-height: 500px;">';
        $html .= '<table class="table table-head-fixed text-nowrap">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Tên</th>';
        $html .= '<th class="text-center">Sản phẩm</th>';
        $html .= '<th>Giá</th>';
        $html .= '<th>Hãng</th>';
        $html .= '<th>Số lượng</th>';
        $html .= '<th>Thành tiền</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody id="listproduct_couponin4">';

        foreach ($productlist as $pr) {
            $html .= '<tr>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->product->nameproduct . '</td>';
            $html .= '<td class="text-center"><img src="' . $pr->product->imageproduct . '" alt="" height="50"></td>';
            $html .= '<td class="font-weight-bold" style="color:red">' . $pr->product->price . ' $</td>';
            $html .= '<td class="font-weight-bold">' . $pr->product->category->namecategory . '</td>';
            $html .= '<td class="font-weight-bold">' . $pr->quantity . '</td>';
            $html .= '<td class="font-weight-bold" style="color:red">' . ($pr->product->price * $pr->quantity) . ' $</td>';
            $html .= '</tr>';
        }

        $html .= '<tr>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td class="font-weight-bold" style="color:red">Phí giao:</td>';
        $html .= '<td class="font-weight-bold" style="color:red">0 $</td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td class="font-weight-bold" style="color:red">Tổng tiền:</td>';
        $html .= '<td class="font-weight-bold" style="color:red">' . $pr->order->totalprice . ' $</td>';
        $html .= '</tr>';
        
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';


        return response()->json([
            'html' => $html,
        ]);
    }

    public function successorder(Request $request)
    {
        $order = Order::where('idorder', $request['idorder'])->first();
        $order->status = 'ship';
        $order->save();

        return redirect()->route('listorder.page');
    }

    public function denyorder(Request $request)
    {
        $order = Order::where('idorder', $request['idorder'])->first();
        $reason = $request['reason'];
        $order->reason = $reason;
        $order->status = 'cancel';
        $order->save();

        $user = User::where('iduser', $request['iduser'])->first();
        $nameuser = $user->firstname . ' ' . $user->lastname;
        $mail = $user->email;
        $result = Mail::send('admin/page/Denyordermail', compact('reason', 'mail', 'nameuser'), function($email) use ($request, $reason, $mail, $nameuser) {
            $email->subject('Về đơn giao hàng của bạn');
            $email->to($mail);
        });

        return redirect()->route('listorder.page');
    }

    public function listrevenuepage(Request $request)
    {
        $revenue = Order::where('status', 'done')->get();

        return view('admin/page/Listrevenuepage', compact('revenue'));

    }
    
}