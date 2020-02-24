<?php

namespace App\Http\Controllers;

use App\Product;
use App\Carta;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function products()

    {
       //$category = Category::with('products')->where('category_id', 1)->get();
       // $carta = Carta::with('products')->where('id', $carta_id)->first();
       $id = 2;
       $categories = Category::get();
       $products = Category::with('products')->first();
       //dd($products);//тут колекция на нее продуктс  ytн аботает в=а что тогда, all?

      // $products =Category::with('products')->where('id', $id)->first();dd(products);
        //@foreach($products->products as $product)
      //$products = Category::with('products')->get();
       //dd($products);
        //if (Session:: has('totalprice')){
        Session:: has('carta_id')?$totalPrice = Carta::getTotalPrice(session('carta_id')):$totalPrice =0;// так короче вызов .....что еще?ничё буду переваритваьт. ты читер спасибо...да ты тож вырос уже))
        Session:: has('carta_id')?$totalQuantity = Carta::getTotalQuantity(session('carta_id')):$totalQuantity =0;
     // dd($totalQuantity);
        return view('welcome', ['products' => $products,'TotalPrice' => $totalPrice, 'TotalQuantity' => $totalQuantity, 'categories' =>$categories]);
        }


    public function productsite($id)
    {
        {
            $product = Product::with('images')->where('id', $id)->first();

            return view('product', ['product' => $product]);

        }
    }
    public function categorysite($id)
    {
        {
            $products = Category::with('products')->where('id', $id)->first();

            return view('category', ['products' => $products]);

        }
    }
    public function AddToCort()
    {
        $categories = Category::get();
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
$quantity = request()->quantity;
        $quantity = abs($quantity);
        //dd($quantity);
        $TotalPrice =Carta::getTotalPrice($carta_id);
     $TotalQuantity =Carta::getTotalQuantity($carta_id);//вот они
if ($contains_product == true)
{
    //if request()->quantity<0

   DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', $quantity)// А КАК ПО ОДНОМУ УДАЛЯТЬ С КОРЗИНЫ ВМЕСТО ДЕТАЧ ну ты понял_))
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
        $id = 1;
        $products =Category::with('products')->where('id',$id)->first();
       return view('welcome', ['products' => $products,'TotalQuantity' => $TotalQuantity,'TotalPrice' => $TotalPrice, 'carta_id'=>$carta_id, 'categories' =>$categories]);
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
       return view('shopping-cart',['carta' => $carta,'totalPrice' => $totalPrice, 'totalQuantity' => $totalQuantity,'carta_id'=>$carta_id]);


   }

    public function checkout()
    {
        $carta_id = session('carta_id');
        //dd($carta_id);
        $order = new Order;
        $order->carta_id = $carta_id;
        $order->save();
        //dd($order);
        request()->session()->flash('carta_id', $carta_id);
        // $order = Order::firstOrCreate(['carta_id' => $carta_id]);
        //dd($order);
        $carta = Carta::with('products')->where('id', $carta_id)->first();
        //$products_checkout = Order::get();


        $totalPrice = Carta::getTotalPrice($carta_id);
        $totalQuantity = Carta::getTotalQuantity($carta_id);
        //$products_checkout = Carta::with('products')->where('id', $carta_id)->first();
        //$products_checkout = Order::find(1)->cartas()->where (`id`,$carta_id)->first();
        // dd($products_checkout);


        //$orders = Order::with('cartas')->get();
        //  request()->session()->flash('carta_id');
        return view('checkout', ['carta' => $carta, 'totalQuantity' => $totalQuantity, 'totalPrice' => $totalPrice]);

    }

}