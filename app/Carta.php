<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
   // protected $primaryKey = 'id';
    public function products()
    {
        return $this->belongsToMany('App\Product','carta_product','carta_id')->withPivot('quantity');
    }

    public static function getTotalPrice($id)// вот с этим разберись унгу, я про это же
    {
        $carta = Carta::with('products')->where('id', $id)->first();

        $totalPrice = 0;

        foreach($carta->products as $product)
        {
            $quantity = $product->pivot->quantity;
            //dd($quantity);
            $price = ($product->price) * $quantity;
            // dd($price);
            $totalPrice +=$price;

        }

        return $totalPrice;
    }
}