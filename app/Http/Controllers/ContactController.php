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
use App\Models\Contact;
use App\Models\Type;
use App\Models\Order_product;
use App\Models\Category_coupon;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactpage(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $contact = Contact::where('status', 'wait')->orderBy('created_at', 'desc')->get();
        $ccontact = $contact->count();
        return view('admin/page/Contactpage', compact('admin','contact','ccontact'));
    }

    
}