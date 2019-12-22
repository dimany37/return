<?php

namespace App\Http\Controllers;

use App\Product;
use App\Carta;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;

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
        if (!Session:: has('carta_id')) {
            $carta = new Carta;
            $carta->save();
            request()->session()->put('carta_id', $carta->id);}



$carta_id = request()->session()->get('carta_id');
        //dd($carta_id);
$carta = Carta::where('id' , $carta_id)->first();
      // dd($carta);
$product = request()->get('product');
       // dd($product);
$product_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
     // dd($product_cart);
$contains_product = $product_cart->contains('product_id', $product);
      ($contains_product);
if ($contains_product == true)
{
    //$carta->products()->sync($product, ['quantity' => request()->quantity+'quantity']);
   $product_in_cart = DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
   //($product_in_cart);
}
else
{
    $carta->products()->attach($product, ['quantity' => request()->quantity]);}

      //  $products_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
        //return view('Product-cart', ['products_cart' => $products_cart]);
        $products = Product::with('images')->get();
        return view('welcome', ['products' => $products]);
    //dd(request()->quantity);
   //$quantity_in_cart = DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
    //dd($carta->products()->pivot()->quantity);
   // $carta->products()->pivot()->quantity->attach(request()->quantity);
}


   // }
  //  public function getCart(){
   //    if (!Session::has('cart')){
    //       return view('shopping-cart', ['products'=>null]);
      // }
        //$oldCart = Session::get('cart');
      //  $cart = new Cart($oldCart);
       // return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    //   }
   public function getCart(){

       $carta_id = request()->session()->get('carta_id');
       $products_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
       $products_cart->toArray();

      dd($products_cart);
       $products = Product::with('images')->where(['id','=', $products_cart->product_id])->get();


      dd($products);
       return view('shopping-cart',['products' => $products]);


   }




     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}