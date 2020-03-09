<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }

    public function shipment()
    {
        return $this->hasOne('App\Shipment');
    }
}
