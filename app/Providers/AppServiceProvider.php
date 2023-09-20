<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Import model Friend
use App\Models\Category; // Import model Friend
use App\Models\Type; // Import model Friend
use App\Models\Cart; // Import model Friend
use App\Models\Cart_product; // Import model Friend

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['admin/page/Changepasswordpage', 
                        'admin/page/Homepage', 
                        'admin/page/Listcategorypage', 
                        'admin/page/Listcouponpage', 
                        'admin/page/Listexpiredcouponpage',
                        'admin/page/Listorderpage',
                        'admin/page/Listshiporderpage',
                        'admin/page/Listcancelorderpage',
                        'admin/page/Listproductpage',
                        'admin/page/Listtypepage',
                        'admin/page/Listrevenuepage',
                        'admin/page/Listspendpage',
                        'admin/page/Listuserpage',
                        'admin/page/Homepage',], function ($view) {
                            
                            
            $countorder = Order::where('status', 'wait')->count();
            $countorder2 = Order::where('status', 'ship')->count();

            $view->with([
                'countorder' => $countorder,
                'countorder2' => $countorder2,

            ]);
            
        });

        View::composer(['user/page/Cartpage', 
                        'user/page/Homepage', 
                        'user/page/Checkoutpage', 
                        'user/page/Productpage', 
                        'user/page/Shoppage',
                        'user/page/Wishlistpage',
                        'user/page/Userpage',], function ($view) {

            $ccart_product = 0;
            $scart_product = 0;

            $user = Auth::user();
            if($user){
                $cart = Cart::where('iduser', $user->iduser)->first();
                if($cart){
                    $ccart_product = Cart_product::where('idcart', $cart->idcart)->count();
                    $scart_product = Cart_product::where('idcart', $cart->idcart)->sum('totalprice');
                }
            }
                            
                            
            $category = Category::orderBy('namecategory', 'asc')->get();
            $type = Type::orderBy('nametype', 'asc')->get();

            $view->with([
                'category' => $category,
                'type' => $type,
                'ccart_product' => $ccart_product,
                'scart_product' => $scart_product,
            ]);
            
        });
    }
}