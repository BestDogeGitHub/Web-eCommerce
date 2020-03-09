<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function productTypes()
    {
        return $this->belongsToMany('App\ProductType');
    }
}
