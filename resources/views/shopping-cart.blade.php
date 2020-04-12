@extends('layouts.layout-temlate')
@include('template.header',['cart' => $cart])

@section('content')

      <div id="cart">
          @if(isset($carta) && $totalPrice > 0 )
              @foreach($carta->products as $product)
                  <p>название <span>{{$product->name}}=</span></p>
                  <p>стоимость <span>{{$product->price}}</span></p>
                  <p>Количество <span>{{$product->pivot->quantity}}</span></p>
              <p hidden="true">{{$product->id}}</p>
                  @foreach($product->images as $image)
                      <p>Изображение: <img src="{{ asset('storage/images/'.$image->img)}}" width="100" height="100"></p>
                  @endforeach

                      <button type="submit" onclick='del({{$product->id}},{{$product->pivot->quantity}})'>Удалить</button><br>

              @endforeach
                  <p>Количество товаров <span>{{$totalQuantity}}</span></p>
                  <p>ОБщая стоимость <span>{{$totalPrice}}</span></p>
              @else
              <h1>нет товаров</h1> <a href="{{route('welcome')}}"> HOME</a>
            @endif
      </div>
      <script
              src="https://code.jquery.com/jquery-3.4.1.js"
              integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
              crossorigin="anonymous"></script>
      <script>
         // $(document).ready(function() {
               function del(id, quantity) {
              //$('#del').on('click', function () {
                //let token = $('meta[name="csrf-token"]').attr('content');
                  $.post("{{route('delete')}}", {//это маршрут
                          '_token': '{{ csrf_token() }}',
                          'id': id,
                          'quantity': quantity,///вот эти данные
                      },
                      function (data) {
                          $('#cart').html(data.html);
                      });
            //  });
          }
        //  });
      </script>

      <form method="post" action="{{ route('checkout') }}" enctype="multipart/form-data">

          @csrf
          <button type="submit">оформить заказ</button><br>
          <input type="hidden" value="{{$carta_id}}" name="checkout">
      </form>

      @endsection




