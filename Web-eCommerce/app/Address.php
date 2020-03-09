<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function town()
    {
        return $this->belongsTo('App\Town');
    }

    public function shipments()
    {
        return $this->hasMany('App\Shipment');
    }
}
