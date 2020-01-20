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
       // dd(request()->session());
        //if (Session:: has('totalprice')){
        Session:: has('carta_id')?$totalPrice = Carta::getTotalPrice(session('carta_id')):$totalPrice =0;// так короче вызов .....что еще?ничё буду переваритваьт. ты читер спасибо...да ты тож вырос уже))
        Session:: has('carta_id')?$totalQuantity = Carta::getTotalQuantity(session('carta_id')):$totalQuantity =0;
     // dd($totalQuantity);
        return view('welcome', ['products' => $products,'TotalPrice' => $totalPrice, 'TotalQuantity' => $totalQuantity]);
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

        //dd($TotalPrice);
        if (!Session:: has('carta_id')) {
            $carta = new Carta;
            $carta->save();
            request()->session()->put('carta_id', $carta->id);
        }



$carta_id = session('carta_id');

        //dd($carta_id);
$carta = Carta::where('id' , $carta_id)->first();
      // dd($carta);
$product = request()->get('product');
       // dd($product);
$product_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
     // dd($product_cart);
$contains_product = $product_cart->contains('product_id', $product);
        $TotalPrice =Carta::getTotalPrice($carta_id);
     $TotalQuantity =Carta::getTotalQuantity($carta_id);

if ($contains_product == true)
{
    //$carta->products()->sync($product, ['quantity' => request()->quantity+'quantity']);
   DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
   ;

}
else
{
    $carta->products()->attach($product, ['quantity' => request()->quantity]);

}
        $products = Product::with('images')->get();
       // dd ($TotalQuantity);
        return view('welcome', ['products' => $products,'TotalQuantity' => $TotalQuantity,'TotalPrice' => $TotalPrice]);
       // return view('welcome', ['products' => $products],['TotalQuantity' => $TotalQuantity]);
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



        public function delete(Request $request)
        {
            $carta_id = session('carta_id');
            $product_id = $request->id;
            $quantity = $request->quantity;$quantity = 1;
            $carta = Carta::with('products')->where('id', $carta_id)->first();
            $carta->products()->detach($product_id, $quantity);//
            $carta->save();

            $totalPrice = Carta::getTotalPrice($carta_id);
$totalQuantity =Carta::getTotalQuantity($carta_id);
            $contents = view()->make('template.cart')->with(['carta','totalPrice','totalQuantity'],[$carta, $totalPrice, $totalQuantity]);
        return ['html'=>$contents->render()];


    }



   public function getCart(){

       $carta_id = request()->session()->get('carta_id');
       //dd($carta_id);
       $carta = Carta::with('products')->where('id', $carta_id)->first();

       $totalPrice = Carta::getTotalPrice($carta_id);
       $totalQuantity =Carta::getTotalQuantity($carta_id);
      // dd ($carta->products()->id);
       return view('shopping-cart',['carta' => $carta,'totalPrice' => $totalPrice, 'totalQuantity' => $totalQuantity,]);


   }






     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}