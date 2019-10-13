<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload File</title>
        <style type="text/css">
            table, th, td{
                border: 1px solid;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <form method="post" action="{{ route('upload_file') }}" enctype="multipart/form-data">
             @csrf
            <label>Наименование продукта</label><input type="text" name="name"><br>
            <label>ОПисание</label><input type="text" name="description"><br>
            <label>Цена</label><input type="text"name="price" ><br>
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input type="file" multiple name="file[]">
            <button type="submit">Загрузить</button><br>

        </form>
        <div>
            @if(isset($products))
                @foreach($products as $product) в цикле перебарем все продукты
            <p>Наименование: <span>{{$product->name}}</span></p>
                <p>Цена: <span>{{$product->price}}</span>
            так как картинки у нас тоже массив то их тоже перебираем в цикле
                @foreach($product->images as $image)
                <p>Изображение: <img src="{{ asset('storage/images/'.$image->img)}}"></p>
                 и для каждого продукта выводим картинку
                @endforeach
                @endforeach
            @endif
        </div>

    </body>
</html>

