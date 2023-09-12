<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
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
        if ($searchproduct) {
            $product = $product->where(function($query) use ($searchproduct) {
                $query->where('nameproduct', 'like', '%' . $searchproduct . '%')
                      ->orWhere('price', 'like', '%' . $searchproduct . '%');
            })->orderBy('idproduct', 'desc');
        }
        $product = $product->orderBy('idproduct', 'desc')->paginate($limit);

        return view('admin/page/Listproductpage', compact('admin','product','searchproduct'));
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

        return view('admin/page/Listcategorypage', compact('admin','category','searchcategory'));
    }
}

