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

    public function getParentName()
    {
        return $this->parent->name;
    }

    public function getNumProducts()
    {
        $counter = 0;
        foreach($this->descendants as $descendant) {
            $counter += ProductType::whereHas('categories', function($query) use ($descendant) {
                $query->where('category_product_type.category_id', '=', $descendant->id);
            })->pluck('id')->count();
        }
        if($this->isLeaf()) {
            $counter += ProductType::whereHas('categories', function($query) {
                $query->where('category_product_type.category_id', '=', $this->id);
            })->pluck('id')->count();
        }
        return $counter;
    }
}
