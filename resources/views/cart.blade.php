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
            {{-- Como imagen del producto en el carrito utilizo la primera --}}
            <img class="cart-img" src="/storage/{{$cart->product->images->first()->path}}" alt="Imagen de producto">
          </div>

          <div class="py-2 col-12 col-lg-2">
            <span>{{$cart->product->name}}</span>
          </div>
          <div class="product-info col-12 col-lg-1">
            <span>Talle: {{$cart->size->name}}</span>
          </div>
          <div class="product-info col-12 col-lg-4">

            <span class="p-2">${{getRealPrice($cart->product)}} c/u</span>
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
            <span name='price' class="p-2 ">${{getRealPrice($cart->product)*$cart->quantity}}</span>
            <a href="/deletecart/{{$cart->id}}">
              <span class="hvr-icon" uk-icon="icon: trash"></span>
            </a>
            <br>
            <span name='errorMessage'hidden></span>
          </div>
        </div> {{-- producto --}}
        @endif
      @empty
        <h2 class="text-center">Tu Carrito está vacío</h2>
        <i class="text-center fas fa-shopping-basket"></i>

      @endforelse
    </div> {{-- productos --}}

    <hr class="uk-divider-small">
    <a class="m-3 blueSlate" href="/deletecarts">Vaciar carrito</a>

    <br>

    <h2 id="subtotal" class="text-center">Subtotal: ${{getTotalPrice($carts)}}</h2>
    <br>
    <form class="" action="/checkout" method="post">
      @csrf
      @foreach ($carts as $cart)
        <input type="hidden" name="producto[{{$cart->id}}][cart_id]" value="{{$cart->id}}">
        <input id="cart{{$cart->id}}" type="hidden" name="producto[{{$cart->id}}][cart_quantity]" value="{{$cart->quantity}}">
      @endforeach
      <button id="boton_comprar" class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button>
    </form>
    <br>


  </div>
<script src="/js/cart.js" charset="utf-8"></script>
@endsection
