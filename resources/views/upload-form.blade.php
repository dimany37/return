<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload File</title>
    </head>
    <body>
        <form method="post" action="{{ route('upload_file') }}" enctype="multipart/form-data">
            <label>Наименование продукта</label><input type="text" name="name"><br>
            <label>ОПисание</label><input type="text" name="description"><br>
            <label>Цена</label><input type="text"name="price" ><br>
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input type="file" multiple name="file[]">
            <button type="submit">Загрузить</button><br>

        </form>
    </body>
</html>