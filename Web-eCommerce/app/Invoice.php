<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\PaymentMethod');
    }
}
