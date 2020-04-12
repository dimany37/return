@extends('layouts.layout-temlate')
@include('template.header',['cart' => $cart])

<div>

    <p>Наименование: <span>{{$product->name}}</span></p>
    <p>Цена: <span>{{$product->price}}</span>

        @foreach($product->images as $image)
            <img width="500" height="600" src="{{ asset('storage/images/'.$image->img)}}">

        @endforeach
        <a href="{{route('welcome')}}"> HOME</a>
</div>

