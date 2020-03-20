<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\IvaCategoryObserver;

class IvaCategory extends Model
{
    protected $dispatchesEvents = [
        'updating' => IvaCategoryObserver::class
    ];

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
