<?php

namespace App\Providers;

use App\Product;
use App\Observers\ProductObserver;
use App\Review;
use App\SiteImage;
use App\Observers\ReviewObserver;
use App\IvaCategory;
use App\Observers\IvaCategoryObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Review::observe(ReviewObserver::class);
        IvaCategory::observe(IvaCategoryObserver::class);


        View::share('footerMain', SiteImage::where('site_image_role_id', 11)->get());
        View::share('footerMenu', SiteImage::where('site_image_role_id', 12)->get());
        View::share('footerHelp', SiteImage::where('site_image_role_id', 13)->get());
        View::share('footerContacts', SiteImage::where('site_image_role_id', 14)->get());
    }
}
