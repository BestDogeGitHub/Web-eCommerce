<?php

namespace App\Providers;

use App\Product;
use App\Observers\ProductObserver;
use App\Review;
use App\Observers\ReviewObserver;
use App\IvaCategory;
use App\Observers\IvaCategoryObserver;
use Illuminate\Support\ServiceProvider;

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
    }
}
