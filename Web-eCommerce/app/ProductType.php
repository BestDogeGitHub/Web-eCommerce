<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class ProductType extends Model implements Searchable
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function values()
    {
        return $this->belongsToMany('App\Value');
    }

    public function producer()
    {
        return $this->belongsTo('App\Producer');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('productType.show', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

}
