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
<script type="text/javascript">
  window.addEventListener('load',function(){

    // Buscamos los botones de suma y de resta
    var botones = document.querySelectorAll('button[name="cantidad"]');
    // Organizamos las funciones de los botones de suma y resta
    for (var boton of botones) {
      boton.addEventListener('click',function(){

        // Esta seccion maneja los precios

        // buscamos donde se encuentra el precio total del producto en particular
        var precioProducto = this.parentNode.parentNode.querySelector('span[name=price]');
        var precioProductoHidden = this.parentNode.parentNode.querySelector('input[name=priceHidden]');

        // buscamos el valor del precio individual
        var valorIndividual = this.parentNode.querySelector('input[name="precios"]').value; // ej 3600

        // Busamos la cantidad pedida de este producto
        var productoCantidad = this.parentNode.querySelector("input[name=quantity]").value;

        // Modificamos el span de acuerdo a los cambios realizados
        precioProducto.innerHTML = '$' + valorIndividual * productoCantidad;
        precioProductoHidden.value = valorIndividual * productoCantidad;

        // Modificamos el subtotal
        var subtotal = document.getElementById('subtotal')

        // buscamos los precios de cada producto agregado al carrito
        var preciosProductos = document.querySelectorAll('input[name=priceHidden]');

        // Cada uno lo sumamos a la variable precio final
        var precioFinal = 0;
        for (var precio of preciosProductos) {
          var precioFinal = parseInt(precioFinal) + parseInt(precio.value);
        }

        // Modificamos el subtotal para que refleje los cambios realizados
        subtotal.innerHTML = 'Subtotal: $' + precioFinal;



        // Esta seccion realiza un control de stock

        var quantity = this.parentNode.querySelector('input[name="quantity"]')
        // traigo el select de talle nos provee el id del talle seleccionado
        var size = document.getElementById('size');
        // Buscamos el input que guarda la cantidad del talle seleccionado
        var stock_quantity =this.parentNode.querySelector('input[name="cantidad_max"]')
        // Si la cantidad seleccionada supera al stock
        var mensajeDeError = this.parentNode.parentNode.querySelector('span[name="errorMessage"]')
        var botonComprar = document.getElementById('boton_comprar');
        if (quantity.value>stock_quantity.value) {
          // mensaje de error
          mensajeDeError.removeAttribute('hidden');
          mensajeDeError.innerHTML = "Solamente hay " + stock_quantity.value + " productos disponibles en ese talle!"
          // bloqueamos el boton de comprar
          botonComprar.setAttribute('type','button');
        }
        else if (quantity.value<=stock_quantity.value){
          mensajeDeError.setAttribute('hidden','true');
          mensajeDeError.innerHTML = "";
          botonComprar.setAttribute('type','submit');


          // Organizamos lo que vamos a enviar al backend
          // Este nos va a proveer el id del cart al que se le sumo la cantidad
          var cart_id = this.parentNode.querySelector('input[name="cart_id"]').value;
          // Con este id armamos un string de busqueda
          var string = 'cart'+ cart_id;
          // buscamos el input en donde vamos a enviar la cantidad pedida
          var inputEnvioCantidad = document.getElementById(string);
          // modificamos el valor con la quantity actual
          inputEnvioCantidad.value = quantity.value;
        }


      })
    }

  })
</script>
@endsection
