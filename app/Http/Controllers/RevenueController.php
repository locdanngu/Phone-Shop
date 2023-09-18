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

class RevenueController extends Controller
{
    public function listspendpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        // $order = Order::where('status', 'done')->orderBy('created_at', 'desc')->get();
        $spend = Spend::orderBy('created_at', 'desc')->get();
        $sum = Spend::sum('money');

        if($request->input('year') || $request->input('month') || $request->input('day')){
            $year = $request->input('year');
            $month = $request->input('month');
            $day = $request->input('day');
        
            if ($request->filled('year')) {
                $spend = Spend::orderBy('created_at', 'desc')->whereYear('created_at', $year);
            }
            
            if ($request->filled('month') && $request->filled('year')) {
                $spend = isset($spend) ? $spend->whereMonth('created_at', $month) : Spend::orderBy('created_at', 'desc')->whereMonth('created_at', $month);
            }
            
            if ($request->filled('day') && $request->filled('month') && $request->filled('year')) {
                $spend = isset($spend) ? $spend->whereDay('created_at', $day) : Spend::orderBy('created_at', 'desc')->whereDay('created_at', $day);
            }

            if ($request->filled('day') && !$request->filled('month') && !$request->filled('year')) {
                $spend = Spend::orderBy('created_at', 'desc')->whereDay('created_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $spend = Spend::orderBy('created_at', 'desc')->whereMonth('created_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $spend = Spend::orderBy('created_at', 'desc')->whereDay('created_at', $day)->whereMonth('created_at', $month);
            }
            
            $spend = $spend->get();
            $countspend = $spend->count();
            $sum = $spend->sum('money');
        }

        return view('admin/page/Listspendpage', compact('spend', 'admin', 'sum'));
    }

    public function spendadd(Request $request)
    {
        $spend = new Spend();
        $spend->reason = $request['reason'];
        $spend->money = $request['money'];
        $spend->save();
        return redirect()->route('listspend.page');
    }

    public function spendchange(Request $request)
    {
        $spend = Spend::where('idspend', $request['idspend'])->first();
        $spend->reason = $request['reason'];
        $spend->money = $request['money'];
        $spend->save();
        return redirect()->route('listspend.page');
    }

    public function listrevenuepage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $order = Order::where('status', 'done')->orderBy('updated_at', 'desc')->get();
        $sum = Order::where('status', 'done')->sum('totalprice');

        if($request->input('year') || $request->input('month') || $request->input('day')){
            $year = $request->input('year');
            $month = $request->input('month');
            $day = $request->input('day');
        
            if ($request->filled('year')) {
                $order = Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereYear('updated_at', $year);
            }
            
            if ($request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereMonth('updated_at', $month) : Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereMonth('updated_at', $month);
            }
            
            if ($request->filled('day') && $request->filled('month') && $request->filled('year')) {
                $order = isset($order) ? $order->whereDay('updated_at', $day) : Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereDay('updated_at', $day);
            }

            if ($request->filled('day') && !$request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereDay('updated_at', $day);
            }

            if (!$request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereMonth('updated_at', $month);
            }

            if ($request->filled('day') && $request->filled('month') && !$request->filled('year')) {
                $order = Order::where('status', 'done')->orderBy('updated_at', 'desc')->whereDay('updated_at', $day)->whereMonth('updated_at', $month);
            }
            
            $order = $order->get();
            $countorder = $order->count();
            $sum = $order->sum('totalprice');
        }

        return view('admin/page/Listrevenuepage', compact('order', 'admin', 'sum'));
    }

}