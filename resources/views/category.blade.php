<div>
@foreach($products->products as $product)
    <p>Наименование: <span>{{$product->name}}</span></p>
    <p>Цена: <span>{{$product->price}}</span>
        @foreach($product->images as $image)
            <a href="http://return/products/{{$product->id}}"> <img width="100" height="100"  src="{{ asset('storage/images/'.$image->img)}}"></a>>
        @endforeach
        @endforeach
        <a href="{{route('welcome')}}"> HOME</a>
</div>