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

class OrderController extends Controller
{
    public function listorderpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $order = Order::where('status', 'wait')->get();
        $countorder = $order->count();

        
        if($request->input('year') || $request->input('month') || $request->input('day')){
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
                $order = Order::where('status', 'wait')->whereDay('created_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'wait')->whereMonth('created_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'wait')->whereDay('created_at', $day)->whereMonth('created_at', $month);
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
        $code = $request['code'];

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
        $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Thời gian đặt</span>';
        $html .= '<span class="spanpopup font-weight-bold" style="color:red">' . $id->created_at . '</span>';
        $html .= '</div>';

        if($code == 1){
            $html .= '<div class="input-group mb-3">';
            $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Thời gian giao</span>';
            $html .= '<span class="spanpopup font-weight-bold" style="color:red">' . $id->updated_at . '</span>';
            $html .= '</div>';
        }

        if($code == 2){
            $html .= '<div class="input-group mb-3">';
            $html .= '<span class="input-group-text" id="inputGroup-sizing-default">Lý do hủy đơn</span>';
            $html .= '<span class="spanpopup font-weight-bold" style="color:red">' . $id->reason . '</span>';
            $html .= '</div>';
        }

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

    public function listordershippage(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $order = Order::where('status', 'ship')->get();
        $countorder = $order->count();

        
        if($request->input('year') || $request->input('month') || $request->input('day')){
            $year = $request->input('year');
            $month = $request->input('month');
            $day = $request->input('day');

            if ($request->filled('year')) {
                $order = Order::where('status', 'ship')->whereYear('created_at', $year);
            }
            
            if ($request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereMonth('created_at', $month) : Order::where('status', 'ship')->whereMonth('created_at', $month);
            }
            
            if ($request->filled('day') && $request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereDay('created_at', $day) : Order::where('status', 'ship')->whereDay('created_at', $day);
            }

            if ($request->filled('day') && !$request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'ship')->whereDay('created_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'ship')->whereMonth('created_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'ship')->whereDay('created_at', $day)->whereMonth('created_at', $month);
            }
            
            
            $order = $order->get();
            
            $countorder = $order->count();
        }

        return view('admin/page/Listshiporderpage', compact('admin','order','countorder'));
    }

    public function doneorder(Request $request)
    {
        $order = Order::where('idorder', $request['idorder'])->first();
        $order->status = 'done';
        $order->save();

        return redirect()->route('listordership.page');
    }

    public function listordercancelpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $order = Order::where('status', 'cancel')->orderBy('updated_at', 'desc')->get();
        $countorder = $order->count();

        
        if($request->input('year') || $request->input('month') || $request->input('day')){
            $year = $request->input('year');
            $month = $request->input('month');
            $day = $request->input('day');

            if ($request->filled('year')) {
                $order = Order::where('status', 'cancel')->whereYear('updated_at', $year);
            }
            
            if ($request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereMonth('updated_at', $month) : Order::orderBy('updated_at', 'desc')->where('status', 'cancel')->whereMonth('updated_at', $month);
            }
            
            if ($request->filled('day') && $request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereDay('updated_at', $day) : Order::orderBy('updated_at', 'desc')->where('status', 'cancel')->whereDay('updated_at', $day);
            }

            if ($request->filled('day') && !$request->filled('month') && !$request->filled('year')) {
                $order = Order::orderBy('updated_at', 'desc')->where('status', 'cancel')->whereDay('updated_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::orderBy('updated_at', 'desc')->where('status', 'cancel')->whereMonth('updated_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::orderBy('updated_at', 'desc')->where('status', 'cancel')->whereDay('updated_at', $day)->whereMonth('updated_at', $month);
            }
            
            $order = $order->get();
            
            $countorder = $order->count();
        }

        return view('admin/page/Listcancelorderpage', compact('admin','order','countorder'));
    }

    public function listexpiredcouponpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 5;
        $coupon = new Coupon();
        $searchcouponexpired = $request['searchcouponexpired'];
        
        if ($searchcouponexpired) {
            $coupon = $coupon->where('endtime', '<', Carbon::now())
                             ->where('code', 'like', '%' . $searchcouponexpired . '%')
                             ->where('isdelete', 0);
        }
        $countcoupon = $coupon->where('endtime', '<', Carbon::now())->where('isdelete', 0)->count();

        $coupon = $coupon->where('endtime', '<', Carbon::now())->where('isdelete', 0)->paginate($limit);
        $category = Category::all();
        $product = Product::orderBy('idcategory')->get();

        return view('admin/page/Listexpiredcouponpage', compact('admin','coupon','category','product','countcoupon'));
    }



}