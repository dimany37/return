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

      // dd($TotalPrice);
        return view('welcome', ['products' => $products],['TotalPrice' => $totalPrice]);
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
if ($contains_product == true)
{
    //$carta->products()->sync($product, ['quantity' => request()->quantity+'quantity']);
   DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity);
   //($product_in_cart);

}
else
{
    $carta->products()->attach($product, ['quantity' => request()->quantity]);

}
       // $Total_price = по рукам за такую писанину)) убери все ненужное нифига не видно)

            //  $products_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
        //return view('Product-cart', ['products_cart' => $products_cart]);
        $products = Product::with('images')->get();
      //  dd(request()->session()->get('totalprice'));
        return view('welcome', ['products' => $products],['TotalPrice' => $TotalPrice]);
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
       //dd($carta_id);
       $carta = Carta::with('products')->where('id', $carta_id)->first();
       //dd($carta);
      // $price = DB::table('carta_product')->where('carta_id', $carta_id)->sum('quantity');
       //dd($price);
      //dd($products);
//       $totalPrice = 0;
//
//       foreach($carta->products as $product)
//       {
//           $quantity = $product->pivot->quantity;
//           //dd($quantity);
//           $price = ($product->price) * $quantity;
//          // dd($price);
//           $totalPrice +=$price;
//           request()->session()->put('totalprice', $totalPrice);//зачем сюда вставляешь?чтоб вызвать в другом месте через сссию выглядит не  очень
//
//
//
//
//       }
       //dd($totalPrice);
    //  dd(request()->session());
       $totalPrice = Carta::getTotalPrice($carta_id);

       return view('shopping-cart',['carta' => $carta],['totalPrice' => $totalPrice]);


   }




     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}