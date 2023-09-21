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

        return view('user/page/Cartpage', compact('user','cart'));
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
        $order->note = '';
        $order->reason = '';
        $order->save();

        foreach ($listcart as $cartItem) {
            $order_product = new Order_product();
            $order_product->idorder = $order->idorder;
            $order_product->idproduct = $cartItem->idproduct; 
            $order_product->quantity = $cartItem->quantity; 
            $order_product->save();
        }

        $listcart = Cart_product::where('idcart', $cart->idcart)->delete();
        $cart = Cart::where('iduser', $user->iduser)->delete();

        return redirect()->route('checkout.page');
    }

    public function checkoutpage(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('idorder', $request['idorder'])->first();
        if($order->iduser != $user->iduser){
            return redirect()->route('home.page');
        }else{
            $listorder = Order_product::where('idorder', $request['idorder'])->get();
        }

        return view('user/page/Checkoutpage', compact('user','listorder','order'));
    }

    public function checkoutlist(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('iduser', $user->iduser)->where('status', 'wait2')->orderBy('created_at', 'desc')->get();
        return view('user/page/Checkoutlistpage', compact('user','order'));
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
        if($user->postcode == null){
            $user->country = $request['country'];
            $user->town_city = $request['town_city'];
            $user->state_country = $request['state_country'];
            $user->address = $request['address'];
            $user->apartment = $request['apartment'];
            $user->companyname = $request['companyname'];
            $user->postcode = $request['postcode'];
            $user->ordernote = $request['ordernote'];
            $user->save();
        }else{
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
        }

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

    public function deletemainaddress(Request $request)
    {
        $user = Auth::user();
        $user->postcode = null;
        $user->country = null;
        $user->address = null;
        $user->companyname = null;
        $user->town_city = null;
        $user->state_country = null;
        $user->ordernote = null;
        $user->apartment = null;
        $user->save();
    }


    public function deleteanotheraddress(Request $request)
    {
        $address = Address::where('idaddress', $request['id'])->first();
        $address->delete();
    }

    public function chuyenhuong(Request $request)
    {
        return redirect()->route('user.page')->withErrors(['need' => 'You need at least 1 delivery address']);
    }

}