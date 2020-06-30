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

    <h2 id="subtotal" class="text-center">Subtotal: ${{getTotalPrice($carts)}}</h2>
    <br>

    <button class="d-flex btn bg-dandelion" type="submit" name="button">Comprar</button>
    <br>


  </div>
<script type="text/javascript">
  window.addEventListener('load',function(){

    // Buscamos los botones de suma y de resta
    var botones = document.querySelectorAll('button[name="cantidad"]');
    // var restas = document.querySelectorAll('button[name="restas"]');

    // Organizamos las funciones de los botones de suma y resta
    for (var boton of botones) {
      boton.addEventListener('click',function(){
        // buscamos donde se encuentra el precio total del producto en particular
        var precioProducto = this.parentNode.parentNode.querySelector('span[name=price]');
        var precioProductoHidden = this.parentNode.parentNode.querySelector('input[name=priceHidden]');

        // buscamos el valor del precio individual
        var valorIndividual = this.parentNode.querySelector('input[name="precios"]').value; // ej 3600
        // Busamos la cantidad pedida de este producto
        var productoCantidad = this.parentNode.querySelector("input[name=cantidad]").value;
        // Modificamos el span de acuerdo a los cambios realizados
        precioProducto.innerHTML = valorIndividual * productoCantidad;
        precioProductoHidden.value = valorIndividual * productoCantidad;

        // Modificamos el subtotal
        var subtotal = document.getElementById('subtotal')

        // buscamos los precios de cada producto agregado al carrito
        var preciosProductos = document.querySelectorAll('input[name=priceHidden]');
        console.log(preciosProductos);
        // Cada uno lo sumamos a la variable precio final
        var precioFinal = 0;

        for (var precio of preciosProductos) {
          var precioFinal = parseInt(precioFinal) + parseInt(precio.value);
        }
        // Modificamos el subtotal para que refleje los cambios realizados
        subtotal.innerHTML = 'Subtotal: $' + precioFinal;
      })
    }

    // Estoy probando otra forma de manejar los datos en js
    // Proveyendo el nombre de los inputs nos da acceso a cada uno

    // var prices = document.querySelectorAll('input[name="precios"]')
    // for (var price of prices) {
    //   console.log(price);
    // }
  })
</script>
@endsection
