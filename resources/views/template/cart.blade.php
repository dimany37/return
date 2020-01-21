@if(isset($carta))
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
              echo('нет товаров')
@endif