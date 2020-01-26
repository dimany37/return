<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    // protected $primaryKey = 'id';
    public function products()
    {
        return $this->belongsToMany('App\Product', 'carta_product', 'carta_id')->withPivot('quantity');
    }

    public static function getTotalPrice($id)// вот с этим разберись унгу, я про это же
    {
        $carta = Carta::with('products')->where('id', $id)->first();

        $totalPrice = 0;


        foreach ($carta->products as $product) {
            $quantity = $product->pivot->quantity;
            //dd($quantity);
            $price = ($product->price) * $quantity;
            // dd($price);
            $totalPrice += $price;

        }

        return $totalPrice;
    }

    public static function getTotalQuantity($id)// вот с этим разберись унгу, я про это же
    {
        $carta = Carta::with('products')->where('id', $id)->first();

        $totalQuantity = 0;

        foreach ($carta->products as $product) {
            $quantity = $product->pivot->quantity;
            //dd($quantity);

            $totalQuantity += $quantity;
        }

        return $totalQuantity;
    }
    public static function delQnt($id)// вот с этим разберись унгу, я про это же
    {
        $product_id = request()->id;
        $carta = Carta::with('products')->where('id', $id)->where('product_id', $product_id)->first();



        $quantity = $carta->pivot->quantity-1;
            //dd($quantity);

            //$totalQuantity += $quantity;
        }

       // return $totalQuantity;

}