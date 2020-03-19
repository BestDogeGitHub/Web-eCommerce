<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function values()
    {
        return $this->belongsToMany('App\Value');
    }

    public function producer()
    {
        return $this->belongsTo('App\Producer');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
