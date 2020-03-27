<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteImageRole extends Model
{
    protected $guarded = [];

    public function siteImages()
    {
        return $this->hasMany('App\SiteImage');
    }
}
