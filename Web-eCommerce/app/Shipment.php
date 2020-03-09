<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function carrier()
    {
        return $this->belongsTo('App\Carrier');
    }

    public function deliveryStatus()
    {
        return $this->belongsTo('App\DeliveryStatus');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
