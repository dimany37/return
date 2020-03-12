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
       $categories = Category::get();
       $products = Category::with('products')->first();

        Session:: has('carta_id')?$totalPrice = Carta::getTotalPrice(session('carta_id')):$totalPrice =0;
        Session:: has('carta_id')?$totalQuantity = Carta::getTotalQuantity(session('carta_id')):$totalQuantity =0;
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
        if (!Session:: has('carta_id')) {
            $carta = new Carta;
            $carta->save();
            request()->session()->put('carta_id', $carta->id);
        }
$carta_id = session('carta_id');
$carta = Carta::where('id' , $carta_id)->first();
$product = request()->get('product');
$product_cart = DB::table('carta_product')->where('carta_id','=', $carta_id)->get();
$contains_product = $product_cart->contains('product_id', $product);
$quantity = request()->quantity;
        $quantity = abs($quantity);
        $TotalPrice =Carta::getTotalPrice($carta_id);
     $TotalQuantity =Carta::getTotalQuantity($carta_id);
if ($contains_product == true)
{
   DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product]])->increment('quantity', $quantity);
}
else
{
    $carta->products()->attach($product, ['quantity' => request()->quantity]);
}
        $products = Product::with('images')->get();
        $TotalPrice =Carta::getTotalPrice($carta_id);
        $TotalQuantity =Carta::getTotalQuantity($carta_id);
        $id = 1;
        $products =Category::with('products')->where('id',$id)->first();
       return view('welcome', ['products' => $products,'TotalQuantity' => $TotalQuantity,'TotalPrice' => $TotalPrice, 'carta_id'=>$carta_id, 'categories' =>$categories]);
 }
        public function delete(Request $request){
            $carta_id = session('carta_id');
            $product_id = $request->id;
            $quantity = $request->quantity;
         DB:: table ('carta_product')->where([['carta_id', $carta_id],['product_id',$product_id]])->decrement('quantity', $quantity);
            $carta = Carta::with('products')->where('id', $carta_id)->first();
            $totalPrice = Carta::getTotalPrice($carta_id);
            $totalQuantity =Carta::getTotalQuantity($carta_id);
            $html = view('template.cart',compact('carta','totalPrice','totalQuantity'))->render();
        return compact('html', 'totalPrice', 'totalQuantity');
    }



   public function getCart(){
       $carta = null;
       $totalPrice = $totalQuantity = 0;
            if (request()->session()->get('carta_id')) {
                $carta_id = request()->session()->get('carta_id');
                 $carta = Carta::with('products')->where('id', $carta_id)->first();
                $totalPrice = Carta::getTotalPrice($carta_id);
                $totalQuantity = Carta::getTotalQuantity($carta_id);
             }
       return view('shopping-cart',['carta' => $carta,'totalPrice' => $totalPrice, 'totalQuantity' => $totalQuantity,'carta_id'=>$carta_id]);
   }
    public function checkout()
    {
        $carta_id = session('carta_id');
        $order = new Order;
        $order->carta_id = $carta_id;
        $order->save();
        request()->session()->flash('carta_id', $carta_id);
        $carta = Carta::with('products')->where('id', $carta_id)->first();
        $totalPrice = Carta::getTotalPrice($carta_id);
        request()->session()->put('totalPrice', $totalPrice);
        $totalQuantity = Carta::getTotalQuantity($carta_id);

        return view('checkout', ['carta' => $carta, 'totalQuantity' => $totalQuantity, 'totalPrice' => $totalPrice]);

    }

}