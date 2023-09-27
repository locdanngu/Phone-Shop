<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function custompage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 4;
        $staff = new Admin();
        $countstaff = $staff->where('role', '!=', 'admin')->count();
        $staff = $staff->where('role', '!=', 'admin')->paginate($limit);
        $searchstaff = $request['searchstaff'];
        if ($searchstaff) {
            $staff = Admin::where(function ($query) use ($searchstaff) {
                $query->where('adminname', 'like', '%' . $searchstaff . '%')
                    ->orWhere('name', 'like', '%' . $searchstaff . '%');
            })
            ->where('role', '!=', 'admin');
            $countstaff = $staff->count();
            $staff = $staff->paginate($limit);
        }
        
        return view('admin/page/Custompage', compact('admin','staff','searchstaff','countstaff'));
    }

    public function staffdelete(Request $request)
    {
        $staff = Admin::where('idadmin', $request['iduser'])->delete();
        return redirect()->back();
    }

    public function staffphanquyen(Request $request)
    {   
        $staff = Admin::where('idadmin', $request['iduser'])->first();
        $staff->product = 0;
        $staff->coupon = 0;
        $staff->user = 0;
        $staff->order = 0;
        $staff->revenue = 0;
        $staff->contact = 0;
        if($request['product'] == 1){
            $staff->product = 1;
        }
        if($request['coupon'] == 1){
            $staff->coupon = 1;
        }
        if($request['user'] == 1){
            $staff->user = 1;
        }
        if($request['order'] == 1){
            $staff->order = 1;
        }
        if($request['revenue'] == 1){
            $staff->revenue = 1;
        }
        if($request['contact'] == 1){
            $staff->contact = 1;
        }

        $staff->save();
        return redirect()->back();
    }
}
