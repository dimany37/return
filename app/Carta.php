<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
   // protected $primaryKey = 'id';
    public function products()
    {
        return $this->belongsToMany('App\Product','carta_product','carta_id');
    }
}