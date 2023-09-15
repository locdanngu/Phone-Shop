<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Order; // Import model Friend
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
                        'admin/page/Listproductpage',
                        'admin/page/Listrevenuepage',
                        'admin/page/Listspendpage',
                        'admin/page/Listuserpage',], function ($view) {
                            
                            
            $countorder = Order::where('status', 'wait')->count();
            $countorder2 = Order::where('status', 'ship')->count();

            $view->with([
                'countorder' => $countorder,
                'countorder2' => $countorder2,

            ]);
            
        });
    }
}
