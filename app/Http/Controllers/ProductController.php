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
     $TotalQuantity =Carta::getTotalQuantity($carta_id);//вот они
if ($contains_product == true)
{
    //)))))
   DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', request()->quantity)// А КАК ПО ОДНОМУ УДАЛЯТЬ С КОРЗИНЫ ВМЕСТО ДЕТАЧ ну ты понял_))
   ;
}
else
{
    $carta->products()->attach($product, ['quantity' => request()->quantity]);
}
        $products = Product::with('images')->get();
        $TotalPrice =Carta::getTotalPrice($carta_id);
        $TotalQuantity =Carta::getTotalQuantity($carta_id);
       // dd ($TotalQuantity);
      //  $contents = view('welcome',compact('TotalQuantity','TotalPrice', 'products' ));
       // return ['html'=>$contents->render()];
       return view('welcome', ['products' => $products,'TotalQuantity' => $TotalQuantity,'TotalPrice' => $TotalPrice]);
       // return view('welcome', ['products' => $products],['TotalQuantity' => $TotalQuantity]);
}


   //
        public function delete(Request $request)
        {// dd($request->quantity);
            $carta_id = session('carta_id');// в общем...тебе надо сделать...если 0 то писец не погодь
            $product_id = $request->id;
            $quantity = $request->quantity;//так можно -1? da
            //$quantity =1;
         DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product_id]])->decrement('quantity', $quantity);
            $carta = Carta::with('products')->where('id', $carta_id)->first();
           // $carta->products()->detach($product_id, $quantity);
            //$carta->save();
            $totalPrice = Carta::getTotalPrice($carta_id);

            $totalQuantity =Carta::getTotalQuantity($carta_id);
            $html = view('template.cart',compact('carta','totalPrice','totalQuantity'))->render();
            //dd($carta);
        return compact('html', 'totalPrice', 'totalQuantity');//от массив в чем вопрос?


    }



   public function getCart(){

       $carta = null;
       $totalPrice = $totalQuantity = 0;
            if (request()->session()->get('carta_id')) {
                $carta_id = request()->session()->get('carta_id');
                //dd($carta_id);
                $carta = Carta::with('products')->where('id', $carta_id)->first();

                $totalPrice = Carta::getTotalPrice($carta_id);
                $totalQuantity = Carta::getTotalQuantity($carta_id);
                //foreach ($carta->products as $product)
                //dd($product->pivot->quantity);
             }
       return view('shopping-cart',['carta' => $carta,'totalPrice' => $totalPrice, 'totalQuantity' => $totalQuantity,]);


   }






     //Задача на дом....разобрасться в том что я только что сделал(будут вопросы пиши) и
        //  создать модель Саrt связать ее с продуктами и подумать как добавлять по кнопке купить продукты в корзину Cart

}