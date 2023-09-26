<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Type;
use App\Models\Cart;
use App\Models\Cart_product;
use App\Models\Coupon;
use App\Models\Spend;
use App\Models\Wishlist;
use App\Models\Product_coupon;
use App\Models\Address;
use App\Models\Review;
use App\Models\Contact;
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

        return view('user/page/Shoppage', compact('user','product','countproduct','searchproduct'));

    }

    public function productpage(Request $request)
    {
        $user = Auth::user();
        $product = Product::where('nameproduct', $request['nameproduct'])->first();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(6)->get();
        $review = Review::orderBy('created_at', 'desc')->take(5)->get();


        return view('user/page/Productpage', compact('user','product','list','recent','random','review'));
    }

    public function cartpage(Request $request)
    {
        $user = Auth::user();
        $idcart = Cart::where('iduser', $user->iduser)->first();
        if($idcart){
            $cart = Cart_product::where('idcart', $idcart->idcart)->orderBy('created_at', 'asc')->get();
        }else{
            $cart = '';
        }
        $countaddress = Address::where('iduser', $user->iduser)->count();
        

        return view('user/page/Cartpage', compact('user','cart','countaddress'));
    }

    public function addorder(Request $request)
    {
        $user = Auth::user();

        $cart = Cart::where('iduser', $user->iduser)->first();
        $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
        $listcart = Cart_product::where('idcart', $cart->idcart)->get();

        $order = new Order();
        $order->iduser = $user->iduser;
        $order->status = 'wait2';
        $order->totalprice = $scart_product;
        $order->totalprice2 = $scart_product;
        $order->beforecoupon = $scart_product;
        $order->note = '';
        $order->reason = '';
        $order->save();

        foreach ($listcart as $cartItem) {
            $order_product = new Order_product();
            $order_product->idorder = $order->idorder;
            $order_product->idproduct = $cartItem->idproduct; 
            $order_product->idcategory = $cartItem->product->category->idcategory; 
            $order_product->quantity = $cartItem->quantity; 
            $order_product->save();
        }

        $listcart = Cart_product::where('idcart', $cart->idcart)->delete();
        $cart = Cart::where('iduser', $user->iduser)->delete();

        return redirect()->route('checkout.page', ['idorder' => $order->idorder]);
    }

    public function checkoutpage(Request $request)
    {
        $user = Auth::user();
        $currentTime = now();
        $order = Order::where('idorder', $request['idorder'])->first();
        if($order->iduser != $user->iduser && $order->status != 'wait2'){
            return redirect()->route('home.page');
        }
        $countcoupon = 0;
        $listorder = Order_product::where('idorder', $request['idorder'])->get();
        if($order->idcoupon != null){
            $couponcart = Coupon::where('idcoupon', $order->idcoupon)
                                // ->where('starttime', '<=', $currentTime) 
                                // ->where('endtime', '>=', $currentTime)   
                                ->first();
            if($couponcart){
                $countcoupon = 1;
            }
        }else{
            $couponcart = '';
        }
        
        $idcoupons = $listorder->pluck('idcoupon')->toArray();
        $listcoupon = Coupon::whereIn('idcoupon', $idcoupons)
                            // ->where('starttime', '<=', $currentTime)
                            // ->where('endtime', '>=', $currentTime)
                            ->get();
        $coutlistcoupon = $listcoupon->count();
        $countcoupon = $countcoupon + $coutlistcoupon;

        $order_product = Order_product::where('idorder', $request['idorder'])
            ->whereNotNull('idcoupon')
            ->get();

        if ($order_product->isEmpty()) {
            // Không có mã giảm giá cho product
            $order_product = Order_product::where('idorder', $request['idorder'])->get();
            foreach($order_product as $op){
                if($op->idcoupon == null){
                    $op->totalprice = $op->product->price * $op->quantity;
                }
                $op->save();
            }

            $order->totalprice = $order_product->sum('totalprice');
            $order->beforecoupon = $order->totalprice;
            $order->totalprice2 = $order->totalprice;
            $order->save();

            if($order->idcoupon != null){
                $coupon = Coupon::where('idcoupon', $order->idcoupon)->first();
                if($coupon->discount_type == 'amount'){
                    $order->beforecoupon = $order->totalprice2 - $coupon->discount_amount;
                    $order->save();
                }else{
                    if(($order->totalprice2 * $coupon->discount_amount / 100) > $coupon->max_discount_amount){
                        $order->beforecoupon = $order->totalprice2  - $max_discount_amount;
                        $order->save();
                    }else{
                        $order->beforecoupon = $order->totalprice2  * $coupon->discount_amount - ($order->totalprice2  * $coupon->discount_amount / 100) ;
                        $order->save();
                    }
                    
                }
                
            }
        } else {
            // Có mã giảm giá cho product
            $order_product = Order_product::where('idorder', $request['idorder'])->get();
            
            foreach($order_product as $op){
                $op->totalprice = $op->product->price * $op->quantity;
                if($op->idcoupon == null){
                    $op->beforecoupon = $op->totalprice;
                }else{
                    $coupon = Coupon::where('idcoupon', $op->idcoupon)->first();
                    if($coupon->discount_type == 'amount'){
                        $op->beforecoupon = $op->totalprice - $coupon->discount_amount;
                        $op->save();
                    }else{
                        if(($op->totalprice * $coupon->discount_amount / 100) > $coupon->max_discount_amount){
                            $op->beforecoupon = $op->totalprice  - $coupon->max_discount_amount;
                            $op->save();
                        }else{
                            $op->beforecoupon = $op->totalprice  * $coupon->discount_amount - ($op->totalprice  * $coupon->discount_amount / 100) ;
                            $op->save();
                        }
                        
                    }
                }
               
            }

            $order = Order::where('idorder', $request['idorder'])->first();
            $listorder = Order_product::where('idorder', $request['idorder'])->get();

            $order->totalprice2 = $listorder->sum('beforecoupon');
            if($order->idcoupon == null){
                $order->beforecoupon = $order->totalprice2;
                $order->save();
            }else{
                $coupon = Coupon::where('idcoupon', $order->idcoupon)->first();
                if($coupon->discount_type == 'amount'){
                    $order->beforecoupon = $order->totalprice2 - $coupon->discount_amount;
                    $order->save();
                }else{
                    if(($order->totalprice2 * $coupon->discount_amount / 100) > $coupon->max_discount_amount){
                        $order->beforecoupon = $order->totalprice2  - $coupon->max_discount_amount;
                        $order->save();
                    }else{
                        $order->beforecoupon = $order->totalprice2  * $coupon->discount_amount - ($order->totalprice2  * $coupon->discount_amount / 100) ;
                        $order->save();
                    }
                    
                }
                
            }
        }

        $listaddress = Address::where('iduser', $user->iduser)->get();

        return view('user/page/Checkoutpage', compact('user','listorder','order', 'countcoupon','couponcart','listcoupon','listaddress'));
    }

    public function checkoutlist(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('iduser', $user->iduser)->where('status', 'wait2')->orderBy('created_at', 'desc')->get();
        return view('user/page/Checkoutlistpage', compact('user','order'));
    }


    public function deleteapplycoupon(Request $request)
    {
        $user = Auth::user();
        $pro = Order_product::where('idorder', $request['idorder'])->where('idcoupon', $request['idcoupon'])->get();
        foreach($pro as $p){
            $p->idcoupon = null;
            $p->beforecoupon = $p->product->price * $p->quantity;
            $p->save();
        }

        return redirect()->route('checkout.page', ['idorder' => $request['idorder']]);
    }

    public function deleteapplycouponcart(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('idorder', $request['idorder'])->first();

        $order_product = Order_product::where('idorder', $request['idorder'])
            ->whereNotNull('idcoupon')
            ->get();

        if ($order_product->isEmpty()) {
            // Không có mã giảm giá cho product
            $order->idcoupon = null;
            $order->totalprice2 = $order->totalprice;
            $order->beforecoupon = $order->totalprice;
            $order->save();
        }else{
            $order->idcoupon = null;
            $order->beforecoupon = $order->totalprice2;
            $order->save();
        }

        return redirect()->route('checkout.page', ['idorder' => $request['idorder']]);
    }

    public function checkcoupon(Request $request)
    {
        $user = Auth::user();
        $currentTime = now();
        $coupon = Coupon::where('code', $request['coupon'])->first();
        $trave = 0;


        if(!$coupon){
            return response()->json([
                're' => 0, //mã không tồn tại
            ]);
        }

        if($coupon->starttime > $currentTime){
            return response()->json([
                're' => 1, //mã này chưa bắt đầu
            ]);
        }

        if($coupon->endtime < $currentTime){
            return response()->json([
                're' => 2, //mã này đã hết hạn sử dụng
            ]);
        }


        if($coupon->iduser != null && $user->iduser != $coupon->iduser){
            return response()->json([
                're' => 3, //mã này ko áp dụng cho bạn
            ]);
        }

        if($coupon->applicable_to == 'cart'){
            $order = Order::where('idorder', $request['idorder'])->first();
            
            if($order->totalprice != $order->totalprice2){
                if($order->totalprice2 < $coupon->minimum_order_amount){
                    return response()->json([
                        're' => 4, //đơn hàng chưa đủ mức giá quy định
                    ]);
                }
            }else{
                if($order->totalprice < $coupon->minimum_order_amount){
                    return response()->json([
                        're' => 4, //đơn hàng chưa đủ mức giá quy định
                    ]);
                }
            }

            $order->idcoupon = $coupon->idcoupon;
            $order->save();

            $trave = 1;

        }else{
            $listproduct = Order_product::where('idorder', $request['idorder'])->get();

            if($coupon->product_list == 2){
                $categorylist = Category_coupon::where('idcoupon', $coupon->idcoupon)->pluck('idcategory')->toArray();
                $count = 0;
                foreach ($listproduct as $product) {
                    $idcategory = $product->idcategory;
                    if (in_array($idcategory, $categorylist)) {
                        $product->idcoupon = $coupon->idcoupon;
                        $product->save();
                        $count += 1;
                    }
                }
                
                if($count == 0){
                    return response()->json([
                        're' => 6, //không có sản phẩm áp dụng
                    ]);
                }else{
                    $trave = 1;
                }
            }

            if($coupon->product_list == 1){
                $productlist = Product_coupon::where('idcoupon', $coupon->idcoupon)->pluck('idproduct')->toArray();
                
                $count = 0;
                foreach ($listproduct as $product) {
                    $idproduct = $product->idproduct;
                    if (in_array($idproduct, $productlist)) {
                        $product->idcoupon = $coupon->idcoupon;
                        $product->save();
                        $count += 1;
                        
                    }
                }                

                if($count == 0){
                    return response()->json([
                        're' => 6, //không có sản phẩm áp dụng
                    ]);
                }else{
                    $trave = 1;
                }
            }

            if($coupon->product_list == 0){
                $order = Order::where('idorder', $request['idorder'])->first();
                foreach ($listproduct as $product) {
                    $product->idcoupon = $coupon->idcoupon;
                    $product->save();
                }
                $trave = 1;
            }
        }

        if($trave == 1){
            return response()->json([
                're' => 7, //Áp dụng mã giảm giá thành công
            ]);
        }
    }


    public function deletecheckout(Request $request)
    {
        $user = Auth::user();
        $de = Order_product::where('idorder',$request['idorder'])->delete();
        $de2 = Order::where('idorder',$request['idorder'])->delete();
        return redirect()->back();
    }

    public function loginuser(Request $request)
    {
        $this->validate($request, ['username' => 'required',
                                    'password' => 'required']);
        
        // Lấy thông tin đăng nhập từ đầu vào
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->orWhere('phone', $credentials['username'])
            ->where('status', 'ok')
            ->first();

        if ($user) {
            // Kiểm tra xác thực với thông tin đăng nhập đã tìm thấy
            if (Auth::attempt(['username' => $user->username, 'password' => $credentials['password']]) ||
                Auth::attempt(['email' => $user->email, 'password' => $credentials['password']]) ||
                Auth::attempt(['phone' => $user->phone, 'password' => $credentials['password']])) {
                // Người dùng đã được xác thực thành công
                return redirect()->back();
            } else {
                // Xác thực không thành công
                return redirect()->back()->withErrors(['login' => 'Sai tên đăng nhập, email hoặc số điện thoại hoặc mật khẩu!!!']);
            }
        } else {
            // Không tìm thấy người dùng với thông tin đăng nhập
            return redirect()->back()->withErrors(['login' => 'Không tìm thấy người dùng với thông tin đăng nhập đã nhập!!!']);
        }
    }

    public function checkusername(Request $request)
    {
        if($request['username']){
            $user = User::where('username',$request['username'])->first();
            if($user == null){
                $re = 1;
            }else{
                $re = 0;
            }
        }
        if($request['email']){
            $user = User::where('email',$request['email'])->first();
            if($user == null){
                $re = 1;
            }else{
                $re = 0;
            }
        }
        if($request['phone']){
            $user = User::where('phone',$request['phone'])->first();
            if($user == null){
                $re = 1;
            }else{
                $re = 0;
            }
        }

        return response()->json([
            're' => $re,
        ]);
    }


    public function registeruser(Request $request)
    {
        $input = $request->all();
        $user = User::create([
            'email' => $input['email'],
            'phone' => $input['phone'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'status' => 'ok',
        ]);
        Auth::login($user);

        return redirect()->route('home.page');
    }

    public function logoutuser(Request $request)
    {
        Auth::logout();
        return redirect()->route('home.page');
    }


    public function addcartwithquantity(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('iduser', $user->iduser)->first();
        $in4product = Product::where('idproduct', $request['id'])->first();
        if(!$cart){
            $cart = new Cart();
            $cart->iduser = $user->iduser;
            $cart->save();
        }

        $checkproduct = Cart_product::where('idproduct', $request['id'])->where('idcart', $cart->idcart)->first();
        if($checkproduct){
            $checkproduct->quantity = $checkproduct->quantity + $request['quantity'];
            $checkproduct->totalprice = $checkproduct->quantity * $in4product->price;
            $checkproduct->save();
            $re = 1;
        }else{
            $product = new Cart_product();
            $product->idcart = $cart->idcart;
            $product->idproduct = $request['id'];
            $product->quantity = $request['quantity'];
            $product->totalprice = $request['quantity'] * $in4product->price;
            $product->save();
            $re = 0;
        }

        if($user){
            $cart = Cart::where('iduser', $user->iduser)->first();
            if($cart){
                $ccart_product = Cart_product::where('idcart', $cart->idcart)->count();
                $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
            }else{
                $ccart_product = 0;
                $scart_product = 0;
            }
        }

        $html = '<a href="' . route('cart.page') . '">Cart - <span class="cart-amunt">$' . $scart_product . '</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">' . $ccart_product . '</span></a>';

        return response()->json([
            're' => $re,
            'html' => $html,
        ]);
    }

    public function addcart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('iduser', $user->iduser)->first();
        $in4product = Product::where('idproduct', $request['id'])->first();
        if(!$cart){
            $cart = new Cart();
            $cart->iduser = $user->iduser;
            $cart->save();
        }

        $checkproduct = Cart_product::where('idproduct', $request['id'])->where('idcart', $cart->idcart)->first();
        if($checkproduct){
            $checkproduct->quantity = $checkproduct->quantity + 1;
            $checkproduct->totalprice = $checkproduct->quantity * $in4product->price;
            $checkproduct->save();
            $re = 1;
        }else{
            $product = new Cart_product();
            $product->idcart = $cart->idcart;
            $product->idproduct = $request['id'];
            $product->quantity = 1;
            $product->totalprice = $in4product->price;
            $product->save();
            $re = 0;
        }

        if($user){
            $cart = Cart::where('iduser', $user->iduser)->first();
            if($cart){
                $ccart_product = Cart_product::where('idcart', $cart->idcart)->count();
                $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
            }else{
                $ccart_product = 0;
                $scart_product = 0;
            }
        }

        $html = '<a href="' . route('cart.page') . '">Cart - <span class="cart-amunt">$' . $scart_product . '</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">' . $ccart_product . '</span></a>';

        return response()->json([
            're' => $re,
            'html' => $html,
        ]);
    }

    public function deleteproductcart(Request $request)
    {
        $user = Auth::user();
        $product_cart = Cart_product::where('idcart_product', $request['id'])->first();
        $product_cart->delete();

        
        $cart = Cart::where('iduser', $user->iduser)->first();
        if($cart){
            $ccart_product = Cart_product::where('idcart', $cart->idcart)->count();
            $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
        }else{
            $ccart_product = 0;
            $scart_product = 0;
        }
        

        $html = '<a href="' . route('cart.page') . '">Cart - <span class="cart-amunt">$' . $scart_product . '</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">' . $ccart_product . '</span></a>';

        $html2 ='';
        $html2 = '<th>Order Total</th>';
        $html2 .= '<td><strong><span class="amount" style="font-weight:bold;color:red">$' . $scart_product . '</span></strong></td>';

        return response()->json([
            'html' => $html,
            'html2' => $html2,
        ]);
    }

    public function updateproductcart(Request $request)
    {
        $user = Auth::user();
        $product_cart = Cart_product::where('idcart_product', $request['id'])->first();
        $price2 = Product::where('idproduct', $product_cart->idproduct)->first();
        $price = $price2->price;
        if($request['code'] == 1){
            $product_cart->quantity = $product_cart->quantity - 1;
            $product_cart->totalprice = $product_cart->totalprice - $price;
            $product_cart->save();
        }elseif($request['code'] == 0){
            $product_cart->quantity = $product_cart->quantity + 1;
            $product_cart->totalprice = $product_cart->totalprice + $price;
            $product_cart->save();
        }else{
            $product_cart->quantity = $request['quantity'];
            $product_cart->totalprice = $price * $request['quantity'];
            $product_cart->save();
        }

        $cart = Cart::where('iduser', $user->iduser)->first();
        if($cart){
            $ccart_product = Cart_product::where('idcart', $cart->idcart)->count();
            $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
        }else{
            $ccart_product = 0;
            $scart_product = 0;
        }

        $html = '<a href="' . route('cart.page') . '">Cart - <span class="cart-amunt">$' . $scart_product . '</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">' . $ccart_product . '</span></a>';

        $html2 ='';
        $html2 = '<th>Order Total</th>';
        $html2 .= '<td><strong><span class="amount" style="font-weight:bold;color:red">$' . $scart_product . '</span></strong></td>';

        return response()->json([
            'html' => $html,
            'html2' => $html2,
        ]);
    }

    public function addreview(Request $request)
    {
        $user = Auth::user();
        $add = new Review();
        $add->idproduct = $request['id']; 

        if($user){
            $add->name = $user->firstname . ' ' . $user->lastname;
            $add->email = $user->email; 
            $add->rating = $request['rating']; 
            $add->review = $request['review']; 
            $add->save();
            
        }else{
            $add->name = $request['name']; 
            $add->email = $request['email']; 
            $add->rating = $request['rating']; 
            $add->review = $request['review']; 
            $add->save();
        }

        $html = '';
    
        $html .= '<div class="review">';
        $html .= '<h5 class="username">' . $add->name . ' - ' . $add->email . '</h5>';
        $html .= '<h5>' . $add->review . '</h5>';
        $html .= '<div class="rating-wrap-post" style="display: flex;align-items: center">';
        for ($i = 0; $i < $add->rating; $i++) {
            $html .= '<i class="fa fa-star" style="margin-right:.25em"></i>';
        }
        $html .= '<h6 style="margin:0"> (' . $add->created_at . ')</h6>';
        $html .= '</div>';
        $html .= '</div>';
 
        return response()->json([
            'html' => $html,
        ]);
    }

    public function morereview(Request $request)
    {
        $review = Review::where('idproduct', $request['id'])->orderBy('created_at', 'desc')->take(10)->get();
        $html = ''; // Khởi tạo biến $html là chuỗi rỗng

        foreach($review as $r){
            $html .= '<div class="review">';
            $html .= '<h5 class="username">' . $r->name . ' - ' . $r->email . '</h5>';
            $html .= '<h5>' . $r->review . '</h5>';
            $html .= '<div class="rating-wrap-post" style="display: flex;align-items: center">';
            for ($i = 0; $i < $r->rating; $i++){
                $html .= '<i class="fa fa-star" style="margin-right:.25em"></i>';
            }
            $html .= '<h6 style="margin:0"> (' . $r->created_at . ')</h6>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return response()->json([
            'html' => $html,
        ]);
    }


    public function wishlistpage(Request $request)
    {
        $user = Auth::user();
        $listwish = Wishlist::orderBy('created_at', 'desc')->get();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(2)->get();
        

        return view('user/page/Wishlistpage', compact('user','listwish','recent','random','list'));
    }

    public function deleteproductwishlist(Request $request)
    {
        $user = Auth::user();
        $product_wishlist = Wishlist::where('idwishlist', $request['id'])->first();
        $product_wishlist->delete();
    }

    public function addwishlist(Request $request)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('iduser', $user->iduser)->where('idproduct', $request['id'])->first();
        if($wishlist){
            return response()->json([
                're' => 1,
            ]);
        }else{
            $add = new Wishlist();
            $add->iduser = $user->iduser;
            $add->idproduct = $request['id'];
            $add->save();
            return response()->json([
                're' => 0,
            ]);
        }
    }

    public function userpage(Request $request)
    {
        $user = Auth::user();
        $listaddress = Address::where('iduser', $user->iduser)->get();

        return view('user/page/Userpage', compact('user','listaddress'));

    }

    public function changenameuser(Request $request)
    {
        $user = Auth::user();
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->save();

        return redirect()->back()->withErrors(['name' => 'Change name success']);
    }

    public function addaddress(Request $request)
    {
        $user = Auth::user();
        
        $add = new Address();
        $add->iduser = $user->iduser;
        $add->country = $request['country'];
        $add->town_city = $request['town_city'];
        $add->state_country = $request['state_country'];
        $add->address = $request['address'];
        $add->apartment = $request['apartment'];
        $add->companyname = $request['companyname'];
        $add->postcode = $request['postcode'];
        $add->ordernote = $request['ordernote'];
        $add->save();
        

        return redirect()->back()->withErrors(['addaddress' => 'Add address success']);
    }

    public function changepassword(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request['oldpassword'], $user->password)) {
            return redirect()->back()->withInput()->withErrors(['passold' => 'Old password incorrect']);
        }
        
        if (strlen($request->input('newpassword')) < 6) {
            return redirect()->back()->withInput()->withErrors(['passnewshort' => 'Password requires more than or equal to 6 characters']);
        }
        
        if ($request['oldpassword'] ===  $request['newpassword']) {
            return redirect()->back()->withInput()->withErrors(['passnew' => 'The new password cannot be the same as the old password']);
        } 

        if ($request['newpassword'] !== $request['repassword']) {
            return redirect()->back()->withInput()->withErrors(['passcon' => 'Confirmation password does not match']);
        } 
        
        $user->password = Hash::make($request['newpassword']);

        $user->save();
        return redirect()->back()->withInput()->withErrors(['suc' => 'Password changed successfully']);
    }

    // public function deletemainaddress(Request $request)
    // {
    //     $user = Auth::user();
    //     $user->postcode = null;
    //     $user->country = null;
    //     $user->address = null;
    //     $user->companyname = null;
    //     $user->town_city = null;
    //     $user->state_country = null;
    //     $user->ordernote = null;
    //     $user->apartment = null;
    //     $user->save();
    // }


    public function deleteanotheraddress(Request $request)
    {
        $address = Address::where('idaddress', $request['id'])->first();
        $address->delete();
    }

    public function chuyenhuong(Request $request)
    {
        return redirect()->route('user.page')->withErrors(['need' => 'You need at least 1 delivery address']);
    }

    
    public function bankpayment(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('idorder', $request['idorder'])->first();
        if($order->iduser != $user->iduser && $order->status != 'wait2'){
            return redirect()->route('home.page');
        }

        $listorder = Order_product::where('idorder', $request['idorder'])->get();
        $order_product = Order_product::where('idorder', $request['idorder'])
                                        ->whereNotNull('idcoupon')
                                        ->get();
        $order = Order::where('idorder', $request['idorder'])->first();
        $sumallproduct = 0;
        if ($order_product->isEmpty()) {
            // Không có bản ghi nào có cột idcoupon khác null
            foreach($listorder as $l){
                $sumallproduct += $l->product->price * $l->quantity;
            }
        } else {
            // Có ít nhất một bản ghi có cột idcoupon khác null
            $sumproduct = $listorder->sum('beforecoupon');
            if($order->idcoupon != null){
                $sumallproduct = $order->beforecoupon;
            }else{
                $sumallproduct = $order->totalprice2 ;
            }
        }

        $order->idaddress = $request['address'];
        $order->save();
        $address = Address::where('idaddress', $request['address'])->first();
    
        if($request['payment_method'] == 'bank'){
            return view('user/page/Bankpayment', compact('user', 'order','address'));
        }

        if($request['payment_method'] == 'paypal'){
            return view('user/page/Paypalpayment', compact('user', 'order','address'));
        }

    }

    public function bankpay(Request $request)
    {
        $order = Order::where('idorder', $request['idorder'])->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image/bill/');
            $image->move($path, $filename);
            $order->bill = '/image/bill/' . $filename;
        }
        $order->note = $request['note'];
        $order->status = 'wait';
        $order->pay = 'bank';
        $order->save();

        return redirect()->route('historyorder.page', ['idorder' => $request['idorder']]);

    }

    public function listhistoryorder(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('iduser', $user->iduser)->where('status','!=', 'wait2')->orderBy('updated_at', 'desc')->get();
        return view('user/page/Listhistoryorder', compact('user', 'order'));
    }

    public function historyorder(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('iduser', $user->iduser)->orderBy('updated_at', 'desc')->where('idorder', $request['idorder'])->first();
        $listorder = Order_product::where('idorder', $request['idorder'])->get();
        $countcoupon = 0;
        if($order->idcoupon != null){
            $couponcart = Coupon::where('idcoupon', $order->idcoupon) ->first();
            if($couponcart){
                $countcoupon = 1;
            }
        }else{
            $couponcart = '';
        }
        
        $idcoupons = $listorder->pluck('idcoupon')->toArray();
        $listcoupon = Coupon::whereIn('idcoupon', $idcoupons)->get();
        $coutlistcoupon = $listcoupon->count();
        $countcoupon = $countcoupon + $coutlistcoupon;
        $address = Address::where('idaddress', $order->idaddress)->first();
        return view('user/page/Historyorder', compact('user', 'order','listorder','listcoupon','couponcart','countcoupon','address'));
    }

    public function contact(Request $request)
    {
        $user = Auth::user();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(6)->get();
        $review = Review::orderBy('created_at', 'desc')->take(5)->get();
        return view('user/page/Contactpage', compact('user','list','recent','random','review'));
    }

    public function addcontact(Request $request)
    {
        $user = Auth::user();
        $contact = new Contact();
        if($user){
            $contact->name = $user->firstname . ' ' . $user->lastname;
            $contact->email = $user->email;
            $contact->phone = $user->phone;
            $contact->content = $request['content'];
            $contact->save();
        }else{
            $contact->name = $request['name'];
            $contact->email = $request['email'];
            $contact->phone = $request['phone'];
            $contact->content = $request['content'];
            $contact->save();
        }
        
        return redirect()->back()->withErrors(['suc' => 'submitted successfully!!!']);
    }



}