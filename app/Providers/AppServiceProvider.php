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
                        'admin/page/Listorderpage',
                        'admin/page/Listproductpage',], function ($view) {
                            
                            
            $countorder = Order::where('status', 'wait')->count();

            
            $view->with([
                'countorder' => $countorder,
                
            ]);
            
        });
    }
}
