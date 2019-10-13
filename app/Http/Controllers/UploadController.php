<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request; 
    use Illuminate\Support\Facades\Storage;
    use App\Image;
    use App\Product;

    class UploadController extends Controller
    {
        public function getForm()
        {
            $products = Product::with('images')->get();
            return view('upload-form',['products' => $products ]);
        }

        public function upload(Request $request)
        {
                $id = $this->store($request);

            foreach ($request->file() as $file) {
                foreach ($file as $key => $f) {
                    $f->move(storage_path('app/public/images'), time().'_'.$f->getClientOriginalName());
                    Image::create([
                        'title'=> 'аоаоа'.$key,
                        'product_id' =>  $id,
                        'img' => time().'_'.$f->getClientOriginalName()
                    ]);
                }
            }
            $products = Product::with('images')->get();

            return view('upload-form',['products' => $products ]);        }


        public function store(Request $request)
        {
            // Validate the request...

            $product = new Product;

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();

            return $product->id;
        }

    }
