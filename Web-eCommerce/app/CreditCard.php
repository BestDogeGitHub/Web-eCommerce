<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function company()
    {
        return $this->belongsTo('App\CreditCardCompany','credit_card_company_id');
    }

    /**
     * Accessor Method to retrieve hide number
     */
    public function getHideNumber()
    {
        $number = $this->number;
        if(strlen($number) <= 3) return $number;
        $newstring = $number[0] . $number[1] . $number[2];
        for ($i = 3; $i < strlen($number); $i++){
            $newstring .= '*';
        }
        return $newstring;
    }
}
