@extends('layouts.plantilla')
@section('titulo')
Checkout
@endsection
@section('main')

  {{-- @if ($total == 0) --}}
    {{-- <label>No tienes productos en tu carrito, <a href="/productos">continuar comprando</a></label> --}}
  {{-- @else --}}

  <div class="row">

    <section id="formulario" class="col-lg-7 p-5">

      <ul class="uk-breadcrumb pb-5 py-2">
        <li><a href="/">Seguir comprando</a></li>
        <li><a href="/">Volver al carrito</a></li>
        <li><span class="dandelion">Checkout</span></li>
      </ul>

      <h3 class="regular text-center pb-3">Elige una forma de <span class="bold blueSlate">pago</span></h3>

      <div class="text-center">
        {{-- Mercado Pago --}}
        <button href="#toggle-animation" class="uk-button uk-button-default mercadopago-payment-button" type="button" uk-toggle="target: #toggle-animation; animation: uk-animation-fade">Mercado Pago <img src=/img/mpicono.jpeg style="padding-bottom: 2px; width: 30px;"></button>
        {{-- Whatsapp --}}
        <a class="uk-button uk-button-default whatsapp-payment-button" href="#">Whatsapp <i class="fab fa-whatsapp" target="_blank" style="font-size: 19px; color:#25D366;"></i></a>
      </div>

      {{-- Despliegue de mercadopago form --}}
      <div id="toggle-animation" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>

        <form class="text-center" action="/{{--{{ route('pay') }}--}}" method="post" id="paymentForm" style="text-align-last: center;">

                  <label class="mt-3">Detalles de la compra:</label><br>

          <div class="form-group-checkout form-row" style="text-align: -webkit-center;">
            <div class="col-12 col-md-6 mb-3">
                <input class="form-control-checkout" type="text" id="cardNumber" data-checkout="cardNumber" placeholder="Numero de tarjeta" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                <small class="fomr-text text-muted">Ej: 4509 9535 6623 3704	</small>
            </div>


            {{-- <div class="col-1"></div> --}}

            <div class="col-12 col-md-6 mb-3">
                <input class="form-control-checkout" type="text" id="cardholderName" data-checkout="cardholderName" placeholder="Nombre completo" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                <small class="fomr-text text-muted">Titular de la tarjeta</small>
            </div>

          </div>

          <div class="justify-content-center form-group-checkout form-row mb-3" style="text-align: -webkit-center;">
            <div class="col-4 col-md-4 justify-content-center" style="text-align: -webkit-center;">
                <input class="form-control-checkout" id="cardExpirationMonth" type="text" data-checkout="cardExpirationMonth" placeholder="MM" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Mes de expiración</small> --}}
            </div>

            <div class="col-4 col-md-4" style="text-align: -webkit-center;">
                <input class="form-control-checkout" id="cardExpirationYear" type="text" data-checkout="cardExpirationYear" placeholder="AA" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Año de expiración</small> --}}
            </div>

            <div class="col-4 col-md-4" style="text-align: -webkit-center;">
                <input class="form-control-checkout" type="text" id="securityCode" data-checkout="securityCode" placeholder="CVC" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Cód. de seguridad</small> --}}
            </div>


            <small class="text-center fomr-text text-muted mt-1">Fecha de expiración, Mes - Año y Código de Seguridad</small>

          </div>

          <div class="form-group-checkout form-row" style="text-align: -webkit-center;">
            <div class="col-12 col-md-2 mb-3">
                <select class="custom-select" id="docType" data-checkout="docType"></select>
                {{-- <small class="invisible text-center fomr-text text-muted">Elija una identificación</small> --}}
            </div>
            <div class="col-12 col-md-2 mb-3">
                <input class="form-control-checkout" type="text" id="docNumber" data-checkout="docNumber" placeholder="N°">
                {{-- <small class="invisible text-center fomr-text text-muted">Identificacion</small> --}}
            </div>
            <div class="col-12 col-md-3 mb-3">
                <input class="form-control-checkout" type="text" placeholder="Teléfono" name="number" value="">
                {{-- <small class="text-center fomr-text text-muted">Tel. de contacto</small> --}}
            </div>
            <div class="col-12 col-md-5 mb-3">
                <input class="form-control-checkout" type="email" placeholder="Email" name="email" value="{{--{{Auth::user()->email}}--}}">
                {{-- <small class="text-center fomr-text text-muted">Ejemplo@ejemplo.com</small> --}}
            </div>

            <div class="d-flex flex-row justify-content-around col-12" style="text-align: -webkit-center;">

              <div class="justify-content-start">
                <label for="si">Envío a domicilo:</label>
                <input type="radio" id="si" name="envio" value="">
              </div>

              <div class="justify-content-end">
                <label for="no">Retiro en sucursal:</label>
                <input type="radio" id="no" name="envio" value="false" checked>
              </div>

            </div>

          <br>


          <div class="form-group-checkout form-row hidden justify-content-center" id='deliveryAddress' style="text-align: -webkit-center;">
            <span class="h6 light text-center">Para saber más sobre los gastos de envío haz{{--{{$shipment}}--}} <a href="/PreguntasFrecuentes" class="text-info">click aquí</a></span>
            <div class="col-12 col-md-6 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Dirección" name="address" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input class="form-control-checkout" type="text" placeholder="CP" name="zipcode" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Piso" name="floor" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Dpto." name="apartment" value="">
            </div>

          </div>


            <div class="col-12">
              <label for="installments">Cuotas:</label>
              <select id="installments" class="form-control-checkout" name="installments"></select>
            </div>
            <input type="hidden" name="amount" id="total" value={{--{{$total}}--}} />
            <input type="hidden" name="description"/>
            <input type="hidden" name="paymentMethodId"/>
            <input type="hidden" name="shipment" id="shipment" value="{{--{{$shipment}}--}}">
          </div>


          {{-- Indica que la moneda va a ser convertida a pesos argentinos --}}
          {{-- <div class="form-group-checkout form-row">
            <div class="col">
                <small class="form-text text-mute"  role="alert" >Tu pago se hara en pesos argentinos. {{ strtoupper(config('services.mercadopago.base_currency')) }}</small>
            </div>
          </div> --}}

          {{-- Aqui se muestran los error que puedan existir y va a ser establecido desde el JS --}}
          <div class="form-group-checkout form-row">
            <div class="col">
                <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
            </div>
          </div>

          <input type="hidden" id="cardNetwork" name="card_network">
          {{-- Input oculto que se usa para el JS --}}

          <input type="hidden" id="cardToken" name="card_token">
          {{-- Input oculto que se usa para el JS --}}
          <div class="text-center mt-3">
            <button type="submit" id="payButton" class=" btn bg-dandelion">Comprar</button>
          </div>
        </form>


      </div>
    </section>

    <section id="carrito" class="col-lg-5 p-5 uk-background-muted">

      <h3 class="regular text-center pb-3">Carrito de <span class="bold blueSlate">compras</span></h3>

      <div class="producto row">
        <div class="img col-12 col-lg-6">
          {{-- Como imagen del producto en el carrito utilizo la primera --}}
          <article>
            <img class="checkout-cart-img" src="/img/anillos.jpg{{--/storage/{{$cart->product->images->first()->path}}--}}" alt="Imagen de producto">
            <span class="new">Nuevo</span>
            <span class="sale">25% off</span>
          </article>
          <article>
            <h6>Rufian{{--{{$cart->product->name}}--}}</h6>
            <h6 class="light">Talle XS / 3 uni.</h6>
          </article>
        </div>

        <div class="product-info col-12 col-lg-6">
          <h6 class="p-2 ">$1.200{{--{{$cart->product->price*$cart->quantity}}--}}</h6>
        </div>
      </div> {{-- producto --}}

      <div class="producto row">
        <div class="img col-12 col-lg-6">
          {{-- Como imagen del producto en el carrito utilizo la primera --}}
          <img class="checkout-cart-img" src="/img/pulseras.jpg{{--/storage/{{$cart->product->images->first()->path}}--}}" alt="Imagen de producto">
          <article class="">
            <h6>Rufian{{--{{$cart->product->name}}--}}</h6>
            <h6 class="light">Talle XS / 3 uni.</h6>
          </article>
        </div>

        <div class="product-info col-12 col-lg-6">
          <h6 class="p-2 ">$1.200{{--{{$cart->product->price*$cart->quantity}}--}}</h6>
        </div>
      </div> {{-- producto --}}

      <div class="calculos pt-4">
        <div class="d-flex justify-content-between">
          <h6>Subtotal</h6>
          <h6>$1.500</h6>
        </div>
        <div class="d-flex justify-content-between">
          <h6>Envío</h6>
          <h6>A calcular</h6>
        </div>
        <div class="d-flex justify-content-between">
          <h4 class="bold">Total</h4>
          <h4 class="bold">$2.000</h4>
        </div>

      </div>
    </section>

  </div>

  <script>

  // Cuando clickean Con envio o Sin envio  Muestra o esconde los datos del domicilio
  // en el formulario checkout y a su vez le da value true al input de Con Envio. Si conEnvio value es true
  // se va a ejecutar la funcion de MP guessingPaymentMethod que se encarga de calcular el total.
  // Ver linea 232 para seguir entendiendo.

  window.addEventListener('load', function() {
    var conEnvio = document.getElementById("si");
    var sinEnvio = document.getElementById("no");
    var deliveryAddress = document.getElementById("deliveryAddress");
    var inputs = document.getElementById("deliveryAddress").getElementsByTagName('input');


    if (conEnvio.hasAttribute('checked')) {
      deliveryAddress.classList.remove("hidden");
    }

    conEnvio.addEventListener('click', function(){
      deliveryAddress.classList.remove("hidden");
      conEnvio.value = "true";
      guessingPaymentMethod('blur');
    })

    sinEnvio.addEventListener('click', function(){
      deliveryAddress.classList.add("hidden");
      conEnvio.value = "false";
      guessingPaymentMethod('blur');
      for (input of inputs) {
        input.value="";
      }
    })

  })

  </script>

@endsection
