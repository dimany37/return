<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function headings()
    {
        return $this->belongsToMany('App\Heading');
    }
}
