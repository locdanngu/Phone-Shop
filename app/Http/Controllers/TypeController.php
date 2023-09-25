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

class TypeController extends Controller
{
    public function listtypepage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $limit = $request->limit ?? 6;
        $type = new Type();
        $searchtype = $request['searchtype'];
        if ($searchtype) {
            $type = $type->where('nametype', 'like', '%' . $searchtype . '%');
        }
        $counttype = $type->count();
        $type = $type->paginate($limit);
        return view('admin/page/Listtypepage', compact('admin','type','searchtype','counttype'));
    }

    public function addtype(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $type = new type();

        $type->nametype = $request['nametype'];
        $type->product_count = 0;

        $type->save();

        return redirect()->route('listtype.page');
    }

    public function changetype(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $type = Type::where('idtype', $request['idtype'])->first();

        $type->nametype = $request['nametype'];
   
        $type->save();

        return redirect()->route('listtype.page');
    }

    public function deletetype(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $type = Type::where('idtype', $request['idtype'])->first();
        $type->delete();
        return redirect()->route('listtype.page');
    }

}