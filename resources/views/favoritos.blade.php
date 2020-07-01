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

    <h2 class="regular text-center pb-3">Tus <span class="bold blueSlate">Favoritos</span></h2>
    <br>
    <div class="productos">
      {{-- @foreach ($favourites as $favourite) --}}
        <div class="producto row">
          <div class="img col-12 col-lg-3">

            {{-- Como imagen del producto en el carrito utilizo la primera --}}
            <img class="cart-img " src="/img/anillos.jpg" alt="Imagen de producto">

            {{-- Si el producto se agrego hace 20 dias o antes aparecera como NUEVO --}}
                <span class="new">Nuevo</span>

            {{-- Si el producto tiene descuento creo un cartelito --}}
            {{-- @if ($product->discount) --}}
                  <span class="sale">25% off</span>
            {{-- @endif --}}

          </div>

          <div class="img col-12 col-lg-3">
            <span>nombre del producto</span>
          </div>

          <div class="py-2 col-12 col-lg-3">
            {{-- Si el producto tiene descuento digo cuanto tiene --}}
            {{-- @if ($product->discount) --}}
                  <span class="">25% off</span>
            {{-- @endif --}}
            {{-- Precio del producto --}}
            {{-- <div class="uk-flex uk-flex-center mb-3"> --}}
              {{-- Con descuento--}}
              {{-- @if ($product->onSale) --}}
              <span class="dandelion mx-1 sinOferta">$2000</span>
              <span class="doveGrey mx-1">$3000</span>
              {{-- @else --}}
                {{-- Sin descuento (precio de lista) --}}
                <span class="doveGrey mx-1">$3000</span>
              {{-- @endif --}}
            </div>

          <div class="product-info col-12 col-lg-3">
            {{-- Al clickear aqui se borra el favorito --}}
            <a class="px-1" href="/deletefavourite">
              <span class="hvr-pulse-shrink isFavourite" uk-icon="icon: heart; ratio: 2"></span>
            </a>
            {{-- Al clickear aqui te lleva al detalle del producto --}}
            <a class="px-1 blueSlate" href="/cart" offset="80">
              <span class="hvr-rotate" uk-icon="icon: cart; ratio: 2"></span>
            </a>
          </div>
        </div> {{-- producto --}}
      {{-- @endforeach --}}
    </div> {{-- productos --}}

    <hr class="uk-divider-small">
    {{-- <a class="m-3" href="/deletecarts">Borrar todos</a> --}}

    <br>
    {{-- <h2 class="text-center">Subtotal: $7.000</h2> --}}
    <br>

    {{-- <button class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button> --}}
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
