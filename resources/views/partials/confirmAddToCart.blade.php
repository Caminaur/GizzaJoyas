{{-- https://youtu.be/7QWZxjgvEQc?t=1204 --}}
{{-- Ejemplo de personalizar el mensaje del modal --}}
{{-- @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'mensaje' => 'seguro?']) --}}

{{-- Es un Modal que nos permite agregar productos favoritos al carrito --}}

<div id="confirm{{$product_object->id}}" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Confirmacion</h2>
        <h3>{{ $mensaje ?? "¿Desea eliminar el producto?"}}</h3>
        <p class="uk-text-right">
            <form class="" action="/cart" method="post">
              @csrf
              <select id="size{{$favourite->id}}" class="size" name="size_id">
                @if (!hasStock($product_object))
                  <option value="">--</option>
                @endif
                {{-- Recorremos todos los stocks del producto --}}
                @foreach ($product_object->stocks as $stock)
                  {{-- En caso de que no haya stock de este talle en particular lo deshabilitamos y le cambiamos
                  un poco el estilo --}}
                  @if (!sizeHasStock($stock))
                    <option style="color:red;" value="{{ $stock->size->id }}" disabled>{{ $stock->size->name }} Sin stock!</option>
                  @else
                    <option value="{{ $stock->size->id }}">{{ $stock->size->name }}</option>
                  @endif
                @endforeach
              </select>
              <input type="number" name="quantity" value="">
              <input type="hidden" name="favourite" value="{{$favourite->id}}">
              <input type="hidden" class="product_id" name="product_id" value="{{$product_object->id}}">
              <div class="">
                <p style="color:red;"></p>
              </div>
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <button type="submit" class="uk-button uk-button-primary boton_agregar" href="{{$url}}">Agregar al carrito</button>
            </form>
        </p>
    </div>
</div>
