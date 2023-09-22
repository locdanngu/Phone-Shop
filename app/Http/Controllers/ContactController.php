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

    public function requestcontact(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $contact = Contact::where('idcontact', $request['idcontact'])->first();
        $resend = $request['resend'];
        $contact->resend = $request['resend'];
        $contact->status = 'done';
        $contact->save();


        $name = $contact->name;
        $mail = $contact->email;
        $phone = $contact->phone;
        $send = $contact->content;

        $result = Mail::send('admin/page/Contactemail', compact('name', 'resend', 'send'), function($email) use ($request,$resend, $send, $mail, $name) {
            $email->subject('Về đơn liên hệ của bạn');
            $email->to($mail);
        });
        return redirect()->back();
    }

    
}