<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany('App\Value');
    }
}
