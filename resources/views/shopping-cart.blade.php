<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

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



      <script
              src="https://code.jquery.com/jquery-3.4.1.js"
              integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
              crossorigin="anonymous"></script>
      <script>
          $(document).ready(function() {
              $('#pay').on('click', function () {

                  $.post("https://checkout.begateway.com/ctp/api/checkouts" ,{
                          "checkout": {
                              "version": 2.1,
                              "test": true,
                              "transaction_type": "payment",
                              "attempts": 3,
                              "settings": {
                                  "success_url": "http://127.0.0.1:4567/success",
                                  "decline_url": "http://127.0.0.1:4567/decline",
                                  "fail_url": "http://127.0.0.1:4567/fail",
                                  "cancel_url": "http://127.0.0.1:4567/cancel",
                                  "notification_url": "http://your_shop.com/notification",
                                  "button_text": "Привязать карту",
                                  "button_next_text": "Вернуться в магазин",
                                  "language": "en",
                                  "customer_fields": {
                                      "visible": ["first_name", "last_name"],
                                      "read_only": ["email"]
                                  }
                              },
                              "order": {
                                  "currency": "GBP",
                                  "amount":"{{$totalPrice}}",
                                  "description": "Order description"
                              },
                              "customer": {
                                  "address": "Baker street 221b",
                                  "country": "GB",
                                  "city": "London",
                                  "email": "jake@example.com"
                              }
                          }
                      },
                      function (data) {
                          alert(data);

                          console.log(data.request.token);
                          console.log(data.request.redirect_url);
                          alert('xuy')
                      })
              })
          })
          //  });
      </script>

          <button type="button" id = "pay" >Оформить и оплатить онлайн </button><br>

      <form action ="{{ route('pay') }}"><button type="button">Оплатить онлайн</button></form>



</body>