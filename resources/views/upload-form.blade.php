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
            <label>Изображение</label><input type="file" multiple name="file[]">
            <label>категория</label><input type="text"name="category_id" ><br>
            <button type="submit">Загрузить</button><br>

        </form>
        <div>
            @if(isset($products))
                @foreach($products as $product)
            <p>Наименование: <span>{{$product->name}}</span></p>
                <p>Цена: <span>{{$product->price}}</span>

                    <p>Категория <span>{{$product->category_id}}</span>

                    <form method="post" action="{{ route('edit') }}" >
                        @csrf
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                    <label></label><input type="text" name="category_id" >
            <button type="submit">Изменить категорию</button><br>
                    </form>
                @foreach($product->images as $image)
                <p>Изображение: <img src="{{ asset('storage/images/'.$image->img)}}"></p>

                @endforeach
                @endforeach
            @endif
        </div>

    </body>
</html>

