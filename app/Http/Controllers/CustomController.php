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
}
