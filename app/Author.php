<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function news()
    {
        return $this->hasMany('App\News');
    } //
}
