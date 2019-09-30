<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request; 
    use Illuminate\Support\Facades\Storage;
    use App\Image;

    class UploadController extends Controller
    {
        public function getForm()
        {
            return view('upload-form');
        }

        public function upload(Request $request)
        { print_r($_POST);
            foreach ($request->file() as $file) {
                foreach ($file as $key => $f) {
                    $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
                    Image::create([
                        'title'=> 'аоаоа'.$key,
                        'img' => time().'_'.$f->getClientOriginalName()
                    ]);
                }
            }
            return "успех";

        }}

            /**
         * Create a new flight instance.
         *
         * @param  Request  $request
         * @return Response

        public function store(Request $request)
        {
            // Validate the request...

            $product = new Product;

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $flight->save();
        }

    }
             */