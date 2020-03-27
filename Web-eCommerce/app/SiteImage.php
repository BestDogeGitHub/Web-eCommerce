<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo('App\SiteImageRole');
    }
}
