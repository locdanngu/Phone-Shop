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

        return view('user/page/Productpage', compact('user','product','list','recent','random'));
    }

    public function cartpage(Request $request)
    {
        $user = Auth::user();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(2)->get();
        $idcart = Cart::where('iduser', $user->iduser)->first();
        if($idcart){
            $cart = Cart_product::where('idcart', $idcart->idcart)->orderBy('created_at', 'asc')->get();
        }else{
            $cart = '';
        }

        return view('user/page/Cartpage', compact('user','list','recent','random','cart'));
    }

    public function checkoutpage(Request $request)
    {
        $user = Auth::user();
        $list = Product::inRandomOrder()->take(4)->get();
        $recent = Product::orderBy('updated_at', 'desc')->take(5)->get();
        $random = Product::inRandomOrder()->take(2)->get();

        return view('user/page/Checkoutpage', compact('user','list','recent','random'));
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
            'html' => $html,
        ]);
    }


}