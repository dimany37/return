<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        //return $this->hasMany('App\Product');
        return $this->belongsToMany('App\Product','category_product','category_id');
}}

