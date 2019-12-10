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
        if (Session::has('carta_id')) {
            $carta = Carta::where("id" , request()->carta_id)->get()->first;
        //dd(request()->session()->all());
            $carta_id=request()->session()->get('carta_id');
            //dd($carta_id);
            $product = request()->get('product');
            //dd($product);
          // $product_Cart_id= $carta->products()->pivot->groupBy('id')->keys();
           // dd($product_Cart_id);
           // $array_product = $carta->products()->pivot()->get([product_id]);
           // dd($array_product);
            $product_cart = DB::table('carta_product')->where('carta_id', '=', $carta_id)->get();
           //dd($product_cart);
            $pluck_product = $product_cart->pluck('product_id');
            dd($pluck_product);
            if (in_array('$product', $pluck_product)){
            $carta->products()->pivot->product_quantity+=request()->quantity;}
            else{


            }

         //   ->pluck('product_id')

          //  $collection = collect(['name' => 'Desk', 'price' => 100])->all();
           // $Product_Cart = $carta->
           // $product = $carta->products()->product_id;
         //   dd(request()->product);
            $product->cartas()->attach(session()->get('carta_id'));
            //$product_quantity = Carta::find(session()->get('carta_id'));dd($product_quantity->products);
            $cart = $product->cartas->where('id', session()->get('carta_id'))->first();
            if ($cart->pivot->product_id === null) {
                $cart->pivot->quantity = request()->quantity;
            } else {
                $cart->pivot->quantity += request()->quantity;
            }
            $cart->pivot->save();
        }


            //$product_quantity->pivot->quantity = request()->quantity;


       else {
            $carta = new Carta;
            $carta->save();

//завели id_cart
        request()->session()->put('carta_id', $carta->id);
           //dd(request()->session()->all());
//закинули в сессию
     // dd(request()->session());
            $product = Product::find(request()->product);
       //dd(request()->quantity);
//нашли продукт с id добавленного товара

            $product->cartas()->attach(session()->get('carta_id'));

        $product_quantity = Product::find(request()->product);
      // dd(request()->product);
        $product_quantity->pivot->quantity+=request()->quantity;


        }
   }


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