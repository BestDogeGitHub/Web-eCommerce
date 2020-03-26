<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ProductObserver;

class Product extends Model
{
    protected $dispatchesEvents = [
        'updating' => ProductObserver::class
    ];

    protected $guarded = [];

    public function usersCart()
    {
        return $this->belongsToMany('App\User', 'cart');
    }

    public function userWish()
    {
        return $this->belongsToMany('App\User', 'wishlist');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }

    public function values()
    {
        return $this->belongsToMany('App\Value');
    }

    public function productType()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function ivaCategory()
    {
        return $this->belongsTo('App\IvaCategory');
    }

    public function getRealPrice()
    {
        return $this->payment - ($this->payment * $this->sale / 100);
    }
}
