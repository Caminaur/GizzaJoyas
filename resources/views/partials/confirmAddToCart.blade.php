{{-- https://youtu.be/7QWZxjgvEQc?t=1204 --}}
{{-- Ejemplo de personalizar el mensaje del modal --}}
{{-- @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'mensaje' => 'seguro?']) --}}

{{-- Es un Modal que nos permite agregar productos favoritos al carrito --}}

<div id="confirm{{$product_object->id}}" uk-modal>

  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación</h2>
    </div>

    <div class="uk-modal-body">
      <p>{{ $mensaje ?? "¿Desea eliminar el producto?"}}</p>
      <br>
      <form action="/cart" method="post">
        @csrf
        <div class="d-flex justify-content-between">
          <input type="hidden" class="favourite_id" name="favourite" value="{{$favourite->id}}">
          <input type="hidden" class="product_id" name="product_id" value="{{$product_object->id}}">
          <p>Talle</p>
          <select id="size{{$favourite->id}}" class="custom-select" name="size_id" style="width: 30%; padding:0 !important">
            @if (!hasStock($product_object))
              <option value="">--</option>
            @endif
            {{-- Recorremos todos los stocks del producto --}}
            @php
                $noHayStockEnNingunTalle = true;
            @endphp
            @foreach ($product_object->stocks as $stock)
              {{-- En caso de que no haya stock de este talle en particular lo deshabilitamos y le cambiamos
              un poco el estilo --}}
              @if (!sizeHasStock($stock))
                <option style="color:red;" value="{{ $stock->size->id }}" disabled>{{ $stock->size->name }} Sin stock!</option>
              @else
                @php
                    $noHayStockEnNingunTalle = false;
                @endphp
                <option value="{{ $stock->size->id }}">{{ $stock->size->name }}</option>
              @endif
            @endforeach
          </select>
          <p>Unidades</p>
          <input class="form-control-checkout px-1 w-25" type="number" name="quantity" min=1 value="" required>
        </div>
        <div>
          <p style="color:red;"></p>
        </div>
    </div>

    <div class="uk-modal-footer text-sm-right text-center">
        @if($noHayStockEnNingunTalle)
            <button disabled='disabled' type="submit" class="uk-button uk-button-primary boton_agregar" href="{{$url}}">Comprar</button>
        @else
            <button type="submit" class="uk-button uk-button-primary boton_agregar" href="{{$url}}">Comprar</button>
        @endif
      </form>
    </div>
  </div>
</div>
