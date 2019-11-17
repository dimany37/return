<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $primaryKey = 'carta_id';
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}