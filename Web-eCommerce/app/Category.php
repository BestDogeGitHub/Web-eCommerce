<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    
    protected $guarded = [];

    public function productTypes()
    {
        return $this->belongsToMany('App\ProductType');
    }

    public function childs()
    {
        return $this->children();
    }
}
