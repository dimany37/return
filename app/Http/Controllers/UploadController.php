<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request; 
    use Illuminate\Support\Facades\Storage;

    use App\Image;
    use App\Product;
    use App\Category;
    use App\News;
    use App\Author;
    use App\Heading;

    class UploadController extends Controller
    {
        public function getForm()
        {
            $products = Product::with('images')->get();
            return view('upload-form', ['products' => $products]);
        }

        public function upload(Request $request)
        {
            $id = $this->store($request);

            foreach ($request->file() as $file) {
                foreach ($file as $key => $f) {
                    $f->move(storage_path('app/public/images'), time() . '_' . $f->getClientOriginalName());
                    Image::create([
                        'title' => 'аоаоа' . $key,
                        'product_id' => $id,
                        'img' => time() . '_' . $f->getClientOriginalName()
                    ]);
                }
            }
            $products = Product::with('images')->get();


            return view('upload-form', ['products' => $products]);
        }


        public function store(Request $request)
        {
            // Validate the request...

            $product = new Product;

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();
            $category = Category::find($request->category_id);
            $product->category()->attach($category);
            return $product->id;
        }

        public function edit(Request $request)
        {
            $product = Product::where('id', request()->product_id)->first();
//dd(request());
            $product->category_id = $request->category_id;
            //   dd($request->category_id);
            // $category = Category::find($request->category_id);
            $product->category()->attach($request->category_id);
            $products = Product::with('images')->get();
            return redirect()->to('/upload_file');
            // return view('upload-form',['products' => $products ]);
        }

        public function uploadNews(Request $request)
        {
            // Validate the request...

            $news = new News;
            $news->title = $request->title;
            $news->description = $request->description;
            $news->author_id = $request->author_id;
            $news->heading = $request->heading;
            $news->save();
            $heading = Heading::find($request->heading);

            $news->headings()->attach($heading);
            return redirect()->to('/upload_news');
            //return $news->id;
        }

        public function getNews()
        {
            $news = News::get();
            return view('upload_news', ['news' => $news]);
        }
    }
