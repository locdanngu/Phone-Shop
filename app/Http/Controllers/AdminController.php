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
        $cproduct = Product::count();
        $cuser = User::count();
        $ccategory = Category::count(); 
        $doanhthuyear = Order::where('status', 'done')->whereYear('updated_at', now()->year)->sum('totalprice');
        $doanhthumonth = Order::where('status', 'done')->whereYear('updated_at', now()->month)->sum('totalprice');

        $dauvaoByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(totalprice) as total_cost')
            ->where('status', 'done')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();
        $dauvaoTotal = array_fill(1, 12, 0);
        foreach ($dauvaoByMonth as $item) {
            $month = $item->month;
            $totalCost = $item->total_cost;
            $dauvaoTotal[$month] = $totalCost;
        }
    
        $dauvaoTotal = json_encode(array_values($dauvaoTotal));

        $currentYear = now()->year;

        $category = Category::pluck('namecategory')->toArray();
        $categoryvalue = "'" . implode("','", $category) . "'";

        $products = Product::orderBy('idcategory', 'asc')->get();
        $productCounts = $products->groupBy('idcategory')->map(function ($products) {
            return $products->count();
        });
        $array = json_decode($productCounts, true);
        $result = '[' . implode(',', $array) . ']';

        return view('admin/page/Homepage', compact('admin','cproduct','ccategory','cuser','doanhthuyear','doanhthumonth','dauvaoTotal','result','categoryvalue','currentYear'));
    }

    public function loginadmin(Request $request){
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

    public function listuserpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 5;
        $user = new User();
        $searchuser = $request['searchuser'];
        if ($searchuser) {
            $user = $user->where(function ($query) use ($searchuser) {
                $query->where('username', 'like', '%' . $searchuser . '%')
                    ->orWhere('firstname', 'like', '%' . $searchuser . '%')
                    ->orWhere('lastname', 'like', '%' . $searchuser . '%')
                    ->orWhere('email', 'like', '%' . $searchuser . '%')
                    ->orWhere('phone', 'like', '%' . $searchuser . '%');
            });
        }
        $countuser = $user->count();
        $user = $user->paginate($limit);

        return view('admin/page/Listuserpage', compact('admin','user','searchuser','countuser'));
    }
    
    public function changepassuser(Request $request)
    {
        $user = User::where('iduser', $request['iduser'])->first();
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect()->route('listuser.page');
    }

    public function changestatususer(Request $request)
    {
        $user = User::where('iduser', $request['iduser'])->first();
        $user->status = $request['status'];
        $user->save();
        return redirect()->route('listuser.page');
    }


    
    

    
}