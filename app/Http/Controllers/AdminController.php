<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginpage(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('adminhome.page');
        }else{
            return view('admin/page/Loginpage');
        }
    }

    public function homepage(Request $request)
    {
        return view('admin/page/Homepage');
    }
}
