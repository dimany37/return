<?php

namespace App\Http\Controllers;

use App\Product;
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
    public function AddToCort()
    {
       // if (Session::has('carta_id')) {
        //    $carta = Carta::find(session()->carta_id);
        //    $carta->product_id = request()->product_id;
         //   $carta->quantity = $carta->quantity+request()->quantity;
         //   $carta->save();
          //  dd(request()->session());
      //  } else {
            $carta = new Carta;
            $carta->save();
//завели id_cart
        request()->session()->put('carta_id', $carta->id);
//закинули в сессию
     // dd(request()->session());
            $product = Product::find(request()->product);
       //dd(request()->quantity);
//нашли продукт с id добавленного товара

            $product->cartas()->attach(session()->get('carta_id'));

        $cart_product = Carta::find(request()->product)->quantity ;
        $cart_product->quantity = (request()->quantity);


        }
   // }


          // dd(request()->session());

       // request()->session()->put('id', $product); dd(request()->session());


   // }
  //  public function AddToCart(){
    //    $product = Product::find(request()->product);
    //    $oldCart = Session::has('cart') ? Session::get('cart'): null;
   //     $cart = new Cart($oldCart);
    //    $cart->add($product, $product->id);
   //     request()->session()->put('cart', $cart);

     //   return redirect()->route('welcome');
   // }
  //  public function getCart(){
   //    if (!Session::has('cart')){
    //       return view('shopping-cart', ['products'=>null]);
      // }
        //$oldCart = Session::get('cart');
      //  $cart = new Cart($oldCart);
       // return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    //   }
   public function getCort(){

       $cartas = Carta::with('products')->get();
             return view('shopping-cort');

        }






     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}