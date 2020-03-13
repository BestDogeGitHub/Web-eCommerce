<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
