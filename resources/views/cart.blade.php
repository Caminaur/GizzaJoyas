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
      @foreach ($carts as $cart)
        <div class="producto row">
          <div class="img col-12 col-lg-4">
            {{-- Como imagen del producto en el carrito utilizo la primera --}}
            <img class="cart-img" src="/img/anillos.jpg{{--/storage/{{$cart->product->images->first()->path}}--}}" alt="Imagen de producto">
          </div>

          <div class="py-2 col-12 col-lg-2">
            <span>Rufian{{--{{$cart->product->name}}--}}</span>
          </div>

          <div class="product-info col-12 col-lg-6">
            <span class="p-2">$1.200{{--{{$cart->product->price}}--}} c/u</span>
            <div class="def-number-input number-input safari_only d-inline-flex">
              <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
              <input class="quantity" min="0" name="quantity" value="1{{--{{$cart->quantity}}--}}" type="number">
              <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
            </div>
            <span class="p-2 ">$1.200{{--{{$cart->product->price*$cart->quantity}}--}}</span>
            <a href="{{--/deletecart/{{$cart->id}}--}}">
              <span class="hvr-icon" uk-icon="icon: trash"></span>
            </a>
          </div>
        </div> {{-- producto --}}
      @endforeach
    </div> {{-- productos --}}

    {{-- <hr class="uk-divider-small"> --}}
    <a class="m-3" href="/deletecarts">Vaciar carrito</a>

    <br>
    <h2 class="text-center">Subtotal: $7.000</h2>
    <br>

    <button class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button>
    <br>


  </div>
<script type="text/javascript">
  window.addEventListener('load',function(){
    var sumas = document.querySelector('.sumar')
    var restas = document.querySelector('.restar')
    sumas.addEventListener('click',function(){
      this.parentNode.querySelector
    })
  })
</script>
@endsection
