@extends('layouts.plantilla')
@section('titulo')
Carrito de compras
@endsection
@section('main')
  <div>

    <ul class="uk-breadcrumb  p-3">
      <li><a href="">Inicio</a></li>
      <li><a href="">Volver</a></li>
      <li><span class="dandelion">Carrito</span></li>
    </ul>

    @if (session()->has('success'))
        <div class="wow animated fadeInDown alert alert-success sticky-notification">
            <ul>
                @foreach (session()->get('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="regular text-center pb-3">Carrito de <span class="bold blueSlate">compras</span></h2>
    <br>
    <div class="productos">
      @forelse ($carts as $cart)

      {{-- Este if tuvo que ser agregado porque a pesar de ser borrado el carrito de la DB seguia apareciendo
        pero con precio de 0 --}}
        @if (getRealPrice($cart->product)*$cart->quantity==0)
        @else
        <div class="producto row">
          <div class="img col-12 col-lg-4">
            <a href="/producto/{{$cart->product->id}}">
              {{-- Como imagen del producto en el carrito utilizo la primera --}}
              <img class="cart-img" src="{{$cart->product->images->first()->path}}" alt="Imagen de producto">
            </a>
          </div>

          <div class="py-2 col-12 col-lg-2">
            <span>{{$cart->product->name}}</span>
          </div>
          <div class="product-info col-12 col-lg-1">
            <span>Talle: {{$cart->size->name}}</span>
          </div>
          <div class="product-info col-12 col-lg-4">

            <span class="p-2">${{number_format((getRealPrice($cart->product)), 0, '.', '.')}}</h2> c/u</span>
            <div class="def-number-input number-input safari_only d-inline-flex">
              {{-- Guardamos el stock maximo de el producto de este carrito --}}
              <input type="hidden" name="cantidad_max" value="{{$maxStock[$cart->id]}}">
              {{-- Guardamos el valor individual de cada producto --}}
              <input type="hidden" name="cart_id" value="{{$cart->id}}">
              <input id="size" type="hidden" name="" value="{{$cart->size->id}}">
              <input name="precios" class="cart_value" type="hidden" value="{{ getRealPrice($cart->product) }}">
              <button type="button" name="cantidad" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
              <input name="quantity" class="quantity" min="1" value="{{$cart->quantity}}" type="number">
              <button type="button" name="cantidad" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
              <input name='priceHidden' type="hidden" name="" value="{{getRealPrice($cart->product)*$cart->quantity}}">
            </div>
            <span name='price' class="p-2 ">${{number_format((getRealPrice($cart->product)*$cart->quantity), 0, '.', '.')}}</span>
            <a href="/deletecart/{{$cart->id}}">
              <span class="hvr-icon" uk-icon="icon: trash"></span>
            </a>
            <br>
            <span name='errorMessage'hidden></span>
          </div>
        </div> {{-- producto --}}


        @endif
      @empty
        <h4 class="text-center">Tu Carrito está vacío, <a href="/productos"><span class="bold blueSlate">Ver Productos</span></h4></a><br>
        {{-- <i class="text-center fas fa-shopping-basket"></i> --}}

      @endforelse
      <hr class="uk-divider-small">
      {{-- <a class="m-3 blueSlate" href="/deletecarts">Vaciar carrito</a> --}}

      <h2 id="subtotal" class="text-center">Total: ${{number_format((getTotalPrice($carts)), 0, '.', '.')}}</h2>
      <br>
      <form class="" action="/checkout" method="post">
        @csrf
        @foreach ($carts as $cart)
          <input type="hidden" name="producto[{{$cart->id}}][cart_id]" value="{{$cart->id}}">
          <input id="cart{{$cart->id}}" type="hidden" name="producto[{{$cart->id}}][cart_quantity]" value="{{$cart->quantity}}">
        @endforeach

        <br>
        {{-- Si hay productos en el carrito --}}
        @if ($carts->count())
          <button id="boton_comprar" class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button>
        @endif
      </form>
      <br>
    </div> {{-- productos --}}


  </div>
<script src="/js/cart.js" charset="utf-8"></script>
@endsection
