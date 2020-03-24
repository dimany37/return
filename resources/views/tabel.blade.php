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
<form method="post" action="{{ route('uploadTabel') }}" enctype="multipart/form-data">
    @csrf
    <label>ФИО</label><input type="text" name="fio"><br>
    <label>ТАбельный номер</label><input type="text" name="tabel"><br>


    <button type="submit">Загрузить</button><br>

</form>
<div>
    @if(isset($tabels))
        @foreach($tabels as $tabel)
            <p>ФИО <span>{{$tabel->name}}</span></p>
            <p>Табель: <span>{{$tabel->tabel}}</span>

            @endforeach

    @endif
</div>

</body>
</html>