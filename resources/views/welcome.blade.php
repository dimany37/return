<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}"
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
        <div class="flex-center position-ref full-height">
                        @if (Route::has('login'))
                <div class="top-right links">
                    <div><a href="{{ route('shopping-cart') }}"> <i class="fa fa-shopping-cart" aria-hidden="true">В корзине <div class="badge" id = "ttq"></div>товаров
                                на сумму <span class="badge" id = "ttp">{{$TotalPrice}}</span>рублей</i></a></div>
                    <script>
                        $(document).ready(function(){
                            $('#button').on('click',function(data){
                                $('#ttq').text("Режим посчитан!");
                            });
                        });
                    </script>


                    <a href="{{ url('/upload_file') }}">Загрузка файлов</a>
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Return1
                </div>
<div>
   @if(isset($products))//в общем это коллекция

            @foreach($products->products as $product)
                <table border="1">
                    <tr>
                        <td>Наименование: <span>{{$product->name}}</span></td>
                        <td>Цена: <span>{{$product->price}}</span></td>

                <p>Наименование: <span>{{$product->name}}</span></p>
                <p>Цена: <span>{{$product->price}}</span>
                @foreach($product->images as $image)
                            <td><a href="http://return/products/{{$product->id}}"><img src="{{ asset('storage/images/'.$image->img)}}" width="100" height="100" ></a></td>
                    <td>
                        <form action="{{ route('AddToCort') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product">
                            <p>количество<span><input  name="quantity"></span></p>

                            <button type="submit" id = "button" >Добавить в корзину</button>
                        </form></td>
                    </tr>
                    </table>
                @endforeach

        @endforeach
    @endif
                </div>
                <div class="links">
                    <a href="{{ url('/upload_file') }}">Загрузка файлов</a>

                </div>
            </div>
        </div>
    </body>
</html>
