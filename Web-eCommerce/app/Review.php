<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ReviewObserver;

class Review extends Model
{
    protected $dispatchesEvents = [
        'created' => ReviewObserver::class,
        'updating'  => ReviewObserver::class,
        'deleted'  => ReviewObserver::class
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function productType()
    {
        return $this->belongsTo('App\ProductType');
    }
}