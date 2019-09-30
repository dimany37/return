<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>������ � ������������� � Laravel</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style type="text/css">
        table, th, td{
            border: 1px solid;
            padding: 5px;
        }
    </style>
</head>
<body&>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>��������</th>                   
                    <th>��������</th> 
                </tr>
            </thead>
            @foreach($images as $image)               
                <tr>
                    <td>{{ $image->id }}</td>                   
                    <td>{{ $image->title }}</td>                   
                    <td><img src="{{ asset('upload/'.$image->img) }}"> </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>