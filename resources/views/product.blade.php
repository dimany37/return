<div>

    <p>Наименование: <span>{{$product->name}}</span></p>
    <p>Цена: <span>{{$product->price}}</span>
        @foreach($product->images as $image)
            <img src="{{ asset('storage/images/'.$image->img)}}">

        @endforeach
    <div>a href="{{route('product.addToCart', ['id'=> $product->id])}} </div>
</div>


