<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $guarded = [];

    public function productTypes()
    {
        return $this->hasMany('App\ProductType');
    }
}
