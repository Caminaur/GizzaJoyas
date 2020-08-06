@extends('layouts.plantilla')
@section('titulo')
Favoritos
@endsection
@section('main')

  <div>

    <ul class="uk-breadcrumb  p-3">
      <li><a href="">Inicio</a></li>
      <li><a href="">Volver</a></li>
      <li><span class="dandelion">Favoritos</span></li>
    </ul>

    @if (!empty($favourites[0]))
      <h2 class="regular text-center pb-3">Tus <span class="bold blueSlate">Favoritos</span></h2>
      <br>
      <div class="productos">
        @forelse ($favourites as $favourite )
          @php
          $product = $favourite->product;
          @endphp
          <div class="producto row">
            <div class="img col-12 col-lg-3">

              {{-- Como imagen del producto en el carrito utilizo la primera --}}
              <img class="cart-img " src="{{$product->images->first()->path}}" alt="Imagen de producto">

              {{-- Si el producto se agrego hace 20 dias o antes aparecera como NUEVO --}}
              <span class="new">Nuevo</span>

              {{-- Si el producto tiene descuento creo un cartelito --}}
              @if ($product->discount)
                <span class="sale">{{$product->discount}}% off</span>
              @endif

            </div>

            <div class="img col-12 col-lg-3">
              <span>{{$product->name}}</span>
            </div>

            <div class="py-2 col-12 col-lg-3">
              {{-- Si el producto tiene descuento digo cuanto tiene --}}
              @if ($product->discount)
                <span class="">{{$product->discount}}% off</span>
              @endif
              {{-- Precio del producto --}}
              {{-- <div class="uk-flex uk-flex-center mb-3"> --}}
              {{-- Con descuento--}}
              @if ($product->onSale)
                <span class="dandelion mx-1 sinOferta">${{getRealPrice($product)}}</span>
                <span class="doveGrey mx-1">${{$product->price}}</span>
              @else
                {{-- Sin descuento (precio de lista) --}}
                <span class="doveGrey mx-1">${{getRealPrice($product)}}</span>
              @endif
            </div>

            <div class="product-info col-12 col-lg-3">
              {{-- Al clickear aqui se borra el favorito --}}
              <a class="px-1" href="/addtofavs/{{$product->id}}">
                <span class="hvr-pulse-shrink isFavourite" uk-icon="icon: heart; ratio: 2"></span>
              </a>
              {{-- Al clickear aqui te lleva al detalle del producto --}}
              <a type="submit" class="px-1 blueSlate" href="" offset="80">
                <span href="#confirm" uk-toggle class="hvr-rotate" uk-icon="icon: cart; ratio: 2"></span>
              </a>
              <a class="px-1 blueSlate" href="/deletefavourite/{{$favourite->id}}">
                <span class="hvr-rotate" uk-icon="icon: trash"></span>
              </a>
              @include('partials.confirmAddToCart',['url'=>'/addToCart','mensaje'=>'Elija un talle y la cantidad para agregar el producto al carrito'])
            </div>
          </div> {{-- producto --}}
        @empty
          <h2 class="regular text-center pb-3">No tienes ningun producto guardado como <span class="bold blueSlate">Favorito</span></h2>
        @endforelse
      </div> {{-- productos --}}
      {{-- Guardamos los stocks de los talles disponibles --}}
      @foreach ($product->stocks as $stock)
        @php
        // Cantidad disponible
          $cantidad = $stock->quantity;
        @endphp
        @foreach (Auth::user()->carts as $cart)
          {{-- Si tienen el mismo size_id --}}
          @if ($cart->size_id==$stock->size_id && $cart->product_id == $stock->product_id)
            @php
            // Cantidad posible para agregar
              $cantidad_a_agregar = $cantidad - $cart->quantity;
            @endphp
          @else
            @php
              $cantidad_a_agregar = $stock->quantity;
            @endphp
          @endif
        @endforeach
        <input type="hidden" name="size_{{$stock->size_id}}" value="{{$cantidad_a_agregar}}">
      @endforeach
      <hr class="uk-divider-small">
      <a class="m-3" href="/deletefavorites">Borrar todos</a>

      <br>
      {{-- <h2 class="text-center">Subtotal: $7.000</h2> --}}
      <br>

      {{-- <button class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button> --}}
      <br>
    @else
      <h2>No tenes productos favoritos</h2>
    @endif


  </div>
<script src="/js/favourites.js" charset="utf-8"></script>
@endsection
