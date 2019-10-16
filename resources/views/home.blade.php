@extends('layouts.app')


<div class="container">
                <div>
                    @if(isset($products))
                        @foreach($products as $product)
                        <p>Наименование: <span>{{$product->name}}</span></p>
                        <p>Цена: <span>{{$product->price}}</span>

                        @endforeach
                    @endif
                </div>
            </div>


