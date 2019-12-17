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
        if (!Session:: has ('carta_id')){
$carta = new Carta;
            $carta->save();
request()->session()->put('carta_id', $carta->id);}


$carta_id = request()->session()->get('carta_id');
        //dd($carta_id);
$carta = Carta::where('id' , $carta_id)->first();
      // dd($carta);
$product = request()->get('product');
       // dd($product);
$product_cart = DB::table('carta_product')->where('carta_id', '$carta_id')->get();
        //dd($product_cart);
$contains_product = $product_cart->contains('product_id', $product);
      // dd($contains_product);
if ($contains_product == true)
{
   $product_in_cart = DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
}
else
{
    $carta->products()->attach($product);
    //dd(request()->quantity);
    $quantity_in_cart = DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
    //dd($carta->products()->pivot()->quantity);
   // $carta->products()->pivot()->quantity->attach(request()->quantity);
}
}
   //{
      //  if (!Session::has('carta_id')) {


         //   $carta = new Carta;
//разберись с ифами

//завели id_cart
       // request()->session()->put('carta_id', $carta->id);
           //dd(request()->session()->all());
//закинули в сессию
     // dd(request()->session());
            //$product = Product::find(request()->product);
       //dd(request()->quantity);
//нашли продукт с id добавленного товара

           /// $product->cartas()->attach(session()->get('carta_id'))->update(['quantity' => request()->quantity]);
      //  }

         //   else{

          //  $carta_id=request()->session()->get('carta_id');
          //  $carta = Carta::where('id' , $carta_id)->first();

          //  $product = request()->get('product');

            // dd($product);
          //  $product_cart = DB::table('carta_product')->where('carta_id', $carta_id)->get();
            //dd($product_cart);
          //  $contains_product = $product_cart->contains('product_id', $product);
            //dd($product);
               // dd($contains_product);
          //  if ($contains_product == true){//семен семеныч.....чем отличется = от == ?

                //dd($contains_product);
            //    $products_in_cart = db::table('carta_product')->where([['carta_id', $carta_id],['product_id', $product]])
            //        ->increment('quantity', request()->quantity);

                //выдает null
                // dd($contains_product);
                //$products_in_cart->insert(['quantity' => request()->quantity]);


          //  } else {//тут ты должен добавить в карту продукт да чё то

           //    $carta->products()->sync($product);
               // dd( $carta_id);//откуда у тебя carta_id если ее нет
                //$product = Product::where("id", $product)->first();
               // $product->cartas()->attach(session()->get('carta_id'));
              //  $product->cartas()->pivot()->quantity->attach(request()->get('quantity')); так можно доюбавлять?
         //        dd($carta);
        //    }
       // }

      //else {





        //$product_quantity = Product::find(request()->get('product'));
      // dd(request()->product);
        //$product_quantity->pivot->quantity+=request()->get('quantity');

          // dd(request()->session());

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
   public function getCort()
   {

       $cartas = Carta::with('products')->get();
       return view('shopping-cort');


   }




     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}