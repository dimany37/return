<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    public function news()
    {
        return $this->belongsToMany('App\News', 'heading_news');
    }
}
