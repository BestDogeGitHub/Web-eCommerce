<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $guarded = [];

    public function shipments()
    {
        return $this->hasMany('App\Shipment');
    }
}
