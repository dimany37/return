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
        return $this->belongsToMany('App\Carta');
    }
}