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
<form method="post" action="{{ route('uploadNews') }}" enctype="multipart/form-data">
    @csrf
    <label>Название нововвсти</label><input type="text" name="title"><br>
    <label>содержание новости</label><input type="text" name="description"><br>
    <label>автор</label><input type="text"name="author_id" ><br>
    <label>рубрика</label><input type="text"name="heading" ><br>
    <button type="submit">Загрузить</button><br>

</form>
<div>
    @if(isset($news))
        @foreach($news as $news)
            <p>Наименование: <span>{{$news->title}}</span></p>
            <p>автор: <span>{{$news->author_id}}</span>


        @endforeach
    @endif
</div>

</body>
</html>
