<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    public function cartas()
    {
        return $this->belongsToMany('App\Carta','carta_product','product_id')->withPivot('quantity');
    }
    public function category()
    {
    //    return $this->belongsTo('App\Category');
        return $this->belongsToMany('App\Category','category_product','product_id');
    }
}