<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function cartas()
    {
        return $this->hasMany('App\Carta');
    }
}
