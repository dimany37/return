<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Carta;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
    public function AddToCort(){
        $carta = new Carta;
        $carta->product_id = request()->product;
        $carta->quantity = '1';
        $carta->save();
        session()->put('carta_id',$carta->carta_id);

        dd(request()->session());
       // request()->session()->put('id', $product); dd(request()->session());


    }
    public function AddToCart(){
        $product = Product::find(request()->product);
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        request()->session()->put('cart', $cart);

        return redirect()->route('welcome');
    }
    public function getCart(){
       if (!Session::has('cart')){
           return view('shopping-cart', ['products'=>null]);
       }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
       }
    public function getCort(Request $request){
        dd($request->all);
        $data = $request->session()->all();
             return view('shopping-cort');
             dd($data);
        }






     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}