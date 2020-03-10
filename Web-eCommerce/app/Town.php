<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $guarded = [];

    public function nation()
    {
        return $this->belongsTo('App\Nation');
    }
}
