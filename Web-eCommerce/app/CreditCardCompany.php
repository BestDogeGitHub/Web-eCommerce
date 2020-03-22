<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCardCompany extends Model
{
    protected $guarded = [];

    public function creditCards()
    {
        return $this->hasMany('App\CreditCard');
    }
}
