<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function products()

    {
        $products = Product::with('images')->get();
        return view('welcome', ['products' => $products]);
        }


    public function productsite($id)
    {
        {
            $product = Product::with('images')->where('id', $id)->first();

            return view('product', ['product' => $product]);
          
        }
    }

    public function checkout()
    {
        dd(request()->product); //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart
    }
}фирштейн?)) угу в целом неплохо...есть сдвиги да уж
